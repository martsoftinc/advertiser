<?php

namespace App\Http\Controllers;
use App\Models\AdgroupModel;
use Illuminate\Http\Request;

class AdgroupController extends Controller
{
    public function showCampaigns($adgroup)
    {
        // Assuming $adgroup is the primary 'id' of the adgroup. If you want to use 'adgroup_id', change to where('adgroup_id', $adgroup)->firstOrFail();
        $adgroup = AdgroupModel::findOrFail($adgroup);
        $campaigns = $adgroup->campaigns()->get();

        return view('adgroups.campaigns', compact('adgroup', 'campaigns'));
    }
}
