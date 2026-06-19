<?php

namespace App\Http\Controllers;
use App\Models\AdgroupModel;
use App\Models\campaignModel;
use Illuminate\Http\Request;
use Auth;

class AdgroupController extends Controller
{
    public function update(Request $request, $id)
{
    $request->validate([
        'adgroup_name' => 'required|string|max:255'
    ]);

    $adgroup = AdgroupModel::where('adgroup_id', $id)
        ->where('user_id', Auth::id())
        ->firstOrFail();

    $adgroup->update([
        'adgroup_name' => $request->adgroup_name
    ]);

    return redirect()->route('adgroup')
        ->with('success', 'Ad group updated successfully!');
}

public function showCampaigns($adgroupId)
{
    $userId = Auth::id();
    
    // Get the ad group
    $adgroup = AdgroupModel::where('adgroup_id', $adgroupId)
        ->where('user_id', $userId)
        ->firstOrFail();
    
    // Get campaigns for this ad group
    $campaigns = campaignModel::where('adgroup_id', $adgroupId)
        ->where('user_id', $userId)
        ->orderBy('created_at', 'desc')
        ->get();
    
    return view('campaign.by-adgroup', compact('campaigns', 'adgroup'));
}

}
