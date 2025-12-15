<?php

namespace App\Http\Controllers;
use App\Models\campaignModel;
use Illuminate\Http\Request;
use App\Models\AdgroupModel;
use Illuminate\Support\Facades\Auth;

class CampaignController extends Controller
{
    public function updateStatus(Request $request, campaignModel $campaign)
    {
        $request->validate([
            'status' => 'required|in:approved,paused',
        ]);

        $campaign->update(['status' => $request->status]);

        return response()->json(['success' => true, 'status' => $campaign->status]);
    }

    public function edit(campaignModel $campaign)
    {
        // This can return a partial view for the modal content via AJAX, but for simplicity, we'll handle the form in the main view
        // If using AJAX, return view('campaigns.edit-modal', compact('campaign'));
        // But below, we'll embed the modal in the campaigns list view
    }

    public function update(Request $request, campaignModel $campaign)
    {
        $request->validate([
            'campaign_name' => 'required|string|max:255',
            'landing_page' => 'required|url',
            'final_url' => 'required|url',
            'end_date' => 'required|date',
            'gender' => 'required|in:male,female,other', // Adjust based on your options
            'referrer' => 'nullable|string',
            'daily_budget' => 'required|numeric|min:0',
            'age_group' => 'required|string', // Adjust as needed
            'cpc' => 'required|numeric|min:0',
            // Add other fields as needed, excluding user_id, adgroup_id, etc., if they shouldn't be editable
        ]);

        $campaign->update($request->only([
            'campaign_name', 
            'landing_page',
            'final_url',
            'end_date',
            'gender',
            'referrer',
            'daily_budget',
            'age_group',
            'cpc',
            // Add 'status' if editable here too
        ]));

        return redirect()->back()->with('success', 'Campaign updated successfully.');
    }

    


}
