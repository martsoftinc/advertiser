<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Models\BalanceModel;
use App\Models\User;


class PaymentController extends Controller
{
   public function initiateTopup(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:10|max:10000',  // Min $10 USD
        ]);

        $amountInCents = $request->amount * 100;  // Cents for USD
        $reference = Str::uuid()->toString();

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.paystack.secret_key'),
            'Content-Type' => 'application/json',
        ])->post('https://api.paystack.co/transaction/initialize', [
            'email' => auth()->user()->email,
            'amount' => $amountInCents,
            'currency' => 'GHS',
            'reference' => $reference,
            'callback_url' => route('payment.callback'),
            'metadata' => [
                'user_id' => auth()->id(),
                'topup_amount' => $request->amount,
            ],
            'custom_fields' => [  // For metadata access in callback
                [
                    'display_name' => 'User ID',
                    'variable_name' => 'user_id',
                    'value' => auth()->id(),
                ],
            ],
        ]);

        if ($response->successful()) {
            $data = $response->json();
            session(['paystack_reference' => $reference, 'topup_amount' => $request->amount]);
            return Redirect::away($data['data']['authorization_url']);
        }

        return back()->withErrors(['error' => 'Payment initialization failed. Please try again.']);
    }

    public function handleCallback(Request $request)
    {
        $reference = $request->query('reference');
        if (!$reference || $reference !== session('paystack_reference')) {
            Log::warning('Invalid reference in Paystack callback', ['reference' => $reference, 'session_ref' => session('paystack_reference')]);
            return redirect('/dashboard')->with('error', 'Invalid payment reference.');
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.paystack.secret_key'),
        ])->get("https://api.paystack.co/transaction/verify/{$reference}");

        Log::info('Paystack Verify Response', [
            'reference' => $reference,
            'status_code' => $response->status(),
            'body' => $response->body(),
        ]);

        if ($response->successful()) {
            $data = $response->json();
            if ($data['status'] && $data['data']['status'] === 'success') {
                $expectedAmount = session('topup_amount', 0) * 100;  // In pesewas for GHS

                if ($data['data']['amount'] == $expectedAmount && $data['data']['currency'] === 'GHS') {
                    // Safe metadata parsing: Handle array or string
                    $metadataRaw = $data['data']['metadata'] ?? '';
                    if (is_array($metadataRaw)) {
                        $metadata = $metadataRaw;
                    } elseif (is_string($metadataRaw)) {
                        $metadata = json_decode($metadataRaw, true) ?: [];
                    } else {
                        $metadata = [];
                    }

                    $userId = $metadata['user_id'] ?? session('user_id', auth()->id());
                    $topupAmount = $metadata['topup_amount'] ?? session('topup_amount', 0);

                    if ($userId) {
                        $user = User::find($userId);
                        if ($user) {
                            // Get or create balance record via relationship
                            $balance = $user->balance()->first() ?? new BalanceModel(['user_id' => $user->id]);
                            
                            // If new, save to create the record
                            if (!$user->balance) {
                                $balance->save();
                                $user->setRelation('balance', $balance);
                            }

                            $balance->balance += $topupAmount;
                            $balance->save();

                            // Optional: Log transaction in a separate table
                            // \App\Models\Transaction::create([
                            //     'user_id' => $userId,
                            //     'amount' => $topupAmount,
                            //     'type' => 'topup',
                            //     'paystack_reference' => $reference,
                            // ]);

                            // Clear session
                            session()->forget(['paystack_reference', 'topup_amount', 'user_id']);

                            Log::info('Balance updated successfully', [
                                'user_id' => $userId,
                                'topup_amount' => $topupAmount,
                                'new_balance' => $balance->balance,
                            ]);

                            return redirect('/dashboard')->with('success', "Top-up of GHS {$topupAmount} successful! Balance updated.");
                        } else {
                            Log::error('User not found in callback', ['user_id' => $userId]);
                            return redirect('/dashboard')->with('error', 'User not found. Contact support.');
                        }
                    } else {
                        Log::error('No user ID in callback metadata or session');
                        return redirect('/dashboard')->with('error', 'Invalid user data. Please try again.');
                    }
                } else {
                    Log::warning('Amount/currency mismatch in callback', [
                        'received_amount' => $data['data']['amount'],
                        'expected' => $expectedAmount,
                        'currency' => $data['data']['currency'],
                    ]);
                    return redirect('/dashboard')->with('error', 'Payment amount or currency mismatch. Please try again.');
                }
            } else {
                Log::error('Paystack transaction not successful', ['data' => $data]);
                return redirect('/dashboard')->with('error', 'Payment not confirmed by Paystack.');
            }
        }

        Log::error('Paystack verification request failed', [
            'status' => $response->status(),
            'body' => $response->body(),
        ]);
        return redirect('/dashboard')->with('error', 'Payment verification failed. Please try again.');
    }
}
