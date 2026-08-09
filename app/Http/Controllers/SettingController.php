<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();

        if (!$setting) {
            $setting = Setting::create([
                'site_name' => 'ShoeWash',
                'phone' => '-',
            ]);
        }

        return view('admin.settings.index', compact('setting'));
    }

    public function update(Request $request, Setting $setting)
    {
        $request->validate([
            'site_name' => 'required|max:255',
            'site_description' => 'nullable',

            'phone' => 'required|max:30',
            'whatsapp' => 'nullable|max:30',
            'email' => 'nullable|email',
            'address' => 'nullable',

            'google_maps' => 'nullable|string',

            'instagram' => 'nullable|max:255',
            'facebook' => 'nullable|max:255',
            'tiktok' => 'nullable|max:255',

            'meta_title' => 'nullable|max:255',
            'meta_description' => 'nullable',
            'meta_keywords' => 'nullable',

            'copyright' => 'nullable|max:255',

            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'favicon' => 'nullable|image|mimes:png,ico|max:1024',
        ]);

        $data = $request->except(['logo', 'favicon']);

        if ($request->hasFile('logo')) {

            if ($setting->logo) {
                Storage::disk('public')->delete($setting->logo);
            }

            $data['logo'] = $request
                ->file('logo')
                ->store('settings', 'public');
        }

        if ($request->hasFile('favicon')) {

            if ($setting->favicon) {
                Storage::disk('public')->delete($setting->favicon);
            }

            $data['favicon'] = $request
                ->file('favicon')
                ->store('settings', 'public');
        }

        $setting->update($data);

        return redirect()
            ->route('admin.settings.index')
            ->with('success', 'Setting berhasil diperbarui.');
    }
}
