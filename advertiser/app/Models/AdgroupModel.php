<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\campaignModel;

class AdgroupModel extends Model
{
    use HasFactory;
    protected $table = "adgroup";
    protected $primaryKey = 'adgroup_id'; // Set primary key
    public $incrementing = false; // Since you're using custom adgroup_id
    protected $fillable = ['adgroup_id', 'adgroup_name', 'user_id'];
    
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($adGroup) {
            $adGroup->adgroup_id = self::generateUniqueAdGroupId();
        });
    }

    private static function generateUniqueAdGroupId()
    {
        do {
            $adGroupId = random_int(1000000000, 9999999999);
        } while (self::where('adgroup_id', $adGroupId)->exists());

        return $adGroupId;
    }

    // Fix the relationship - campaignModel has 'adgroup_id' as foreign key
    public function campaigns()
    {
        return $this->hasMany(campaignModel::class, 'adgroup_id', 'adgroup_id');
    }
}