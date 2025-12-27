<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\campaignModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class VerifyCampaign extends Controller
{
     public function verifyCode(Request $request)
{
    $request->validate([
        'verificationCode' => 'required|string',
        #'id' => 'required|exists:campaigns,id',
    ]);
    
    $job = campaignModel::find($request->id);
    
    if ($job) {
         $clientIp = $request->header('CF-Connecting-IP') ?? 
                   $request->header('X-Forwarded-For') ?? 
                   $request->ip();


        $today = Carbon::now()->toDateString();
        $combinedString = $job->final_url . $today . $clientIp;
        $generatedHash = hash('sha256', $combinedString);
        
        #Log::info('IP: ' . $clientIp);
        #Log::info('Date: ' . $today);
        #Log::info('Final URL: ' . $job->final_url);
        #Log::info('Generated hash: ' . $generatedHash);
        #Log::info('Received code: ' . $request->verificationCode);
        
        
        if (hash_equals($generatedHash, $request->verificationCode)) {
            Log::info('Hash verification successful');
            if ($campaign) {
                    $campaign->status = 'under_review';
                    $campaign->save();
                    
                    return $campaign;
            }
            return back()->with('success', 'Verification successful! Campaign has been activated.');

        } else {
            Log::warning('Hash verification failed');
            return back()->with('error', 'Wrong verification code');
        }
    }
    
    return back()->with('error', 'Campaign not found');
}
}