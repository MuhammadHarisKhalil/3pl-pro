<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'group', 'key', 'value', 'display_name'
    ];

    /**
     * Get a site info value
     */
    public static function getValue($group, $key, $default = null)
    {
        $cacheKey = "site_info.{$group}.{$key}";
        
        return Cache::remember($cacheKey, 3600, function() use ($group, $key, $default) {
            $info = self::where('group', $group)
                      ->where('key', $key)
                      ->first();
            
            return $info ? $info->value : $default;
        });
    }
    
    /**
     * Clear site info cache
     */
    public static function clearCache()
    {
        $infos = self::all();
        foreach ($infos as $info) {
            Cache::forget("site_info.{$info->group}.{$info->key}");
        }
    }
}