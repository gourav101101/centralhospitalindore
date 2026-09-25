<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class AdminSettingController extends Controller
{
    public function edit()
    {
        $settings = SiteSetting::first();
        if (!$settings) {
            $settings = new SiteSetting();
        }
        return view('admin.settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = SiteSetting::first();
        if (!$settings) {
            $settings = new SiteSetting();
        }

        $data = $request->except('_token', '_method');
        
        // Handle checkbox
        $data['show_announcement'] = $request->has('show_announcement');

        $settings->fill($data);
        $settings->save();

        return back()->with('success', 'Site settings updated successfully.');
    }
}
