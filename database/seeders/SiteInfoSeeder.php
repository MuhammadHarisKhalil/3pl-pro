<?php

namespace Database\Seeders;

use App\Models\SiteInfo;
use Illuminate\Database\Seeder;

class SiteInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $siteInfos = [
            // Company Information
            ['group' => 'company', 'key' => 'address', 'value' => '123 Street, New York, USA', 'display_name' => 'Company Address'],
            ['group' => 'company', 'key' => 'phone', 'value' => '+012 345 67890', 'display_name' => 'Company Phone'],
            ['group' => 'company', 'key' => 'email', 'value' => 'info@example.com', 'display_name' => 'Company Email'],
            
            // Social Media
            ['group' => 'social', 'key' => 'twitter', 'value' => 'https://twitter.com', 'display_name' => 'Twitter URL'],
            ['group' => 'social', 'key' => 'facebook', 'value' => 'https://facebook.com', 'display_name' => 'Facebook URL'],
            ['group' => 'social', 'key' => 'linkedin', 'value' => 'https://linkedin.com', 'display_name' => 'LinkedIn URL'],
            ['group' => 'social', 'key' => 'instagram', 'value' => 'https://instagram.com', 'display_name' => 'Instagram URL'],
        ];

        foreach ($siteInfos as $info) {
            SiteInfo::updateOrCreate(
                ['group' => $info['group'], 'key' => $info['key']],
                $info
            );
        }
    }
}