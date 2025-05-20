<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteInfo;
use Illuminate\Http\Request;

class SiteInfoController extends Controller
{
    /**
     * Show the site info settings form
     */
    public function edit()
    {
        // Initialize with empty arrays for each group to ensure they exist
        $siteInfosByGroup = [
            'company' => [],
            'social' => []
        ];
        
        // Get the data from database
        $siteInfos = SiteInfo::orderBy('display_name')->get();
        
        // Group by their group property
        foreach ($siteInfos as $info) {
            $siteInfosByGroup[$info->group][] = $info;  
        }
        
        return view('admin.site-info.edit', compact('siteInfosByGroup'));
    }

    /**
     * Update site info settings
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'info' => 'required|array',
            'info.*.*' => 'nullable|string'
        ]);
        
        foreach ($validated['info'] as $group => $items) {
            foreach ($items as $key => $value) {
                $siteInfo = SiteInfo::where('group', $group)
                    ->where('key', $key)
                    ->first();
                    
                if ($siteInfo) {
                    $siteInfo->value = $value;
                    $siteInfo->save();
                }
            }
        }
        
        SiteInfo::clearCache();
        
        return redirect()->route('admin.site-info.edit')
            ->with('success', 'Site information updated successfully!');
    }
}