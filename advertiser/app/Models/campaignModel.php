<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AdgroupModel;

class campaignModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'campaign_name', 
        'landing_page',
        'final_url',
        'end_date',
        'gender',
        'referrer',
        'daily_budget',
        'age_group',
        'gender',
        'cpc',
        'user_id',
        'adgroup_id',
        'status'];

    protected $table = 'campaigns';

    public function adGroup()
    {
        return $this->belongsTo(AdgroupModel::class, 'adgroup_id','adgroup_id');
    }

     public function user()
{
    return $this->hasMany(User::class);
}

    // Automatically generate a unique 10-digit number when creating a campaign
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($campaign) {
            // Generate a 10-digit unique campaign_id
            $campaign->campaign_id = self::generateUniqueCampaignId();

        
        });
    }

    // Generate a 10-digit unique number
    private static function generateUniqueCampaignId()
    {
        do {
            // Generate a random 10-digit number
            $campaignId = random_int(1000000000, 9999999999);
        } while (self::where('campaign_id', $campaignId)->exists());

        return $campaignId;
    }
   
}
