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

        $data = $request->validate([
            'phone_display' => 'required|string|max:255',
            'phone_href' => 'required|string|max:30|regex:/^\+?[0-9 ()-]+$/',
            'whatsapp_number' => 'required|regex:/^[0-9]{8,15}$/',
            'email' => 'required|email|max:255',
            'working_hours' => 'required|string|max:255',
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'announcement_text' => 'nullable|string|max:255',
            'show_announcement' => 'nullable|boolean',
            'google_rating' => 'nullable|numeric|between:0,5',
            'google_review_count' => 'nullable|integer|min:0',
            'meta_description' => 'nullable|string|max:2000',
            'facebook_url' => 'nullable|url:http,https|max:255',
            'instagram_url' => 'nullable|url:http,https|max:255',
            'twitter_url' => 'nullable|url:http,https|max:255',
            'youtube_url' => 'nullable|url:http,https|max:255',
            'maps_url' => 'nullable|url:http,https|max:2000',
            'directions_url' => 'nullable|url:http,https|max:2000',
            'map_embed_url' => 'nullable|url:http,https|max:2000',
            'outside_view_url' => 'nullable|url:http,https|max:2000',
        ]);
        
        // Handle checkbox
        $data['show_announcement'] = $request->has('show_announcement');

        $settings->fill($data);
        $settings->save();

        return back()->with('success', 'Site settings updated successfully.');
    }
}
