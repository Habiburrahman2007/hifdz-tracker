<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $institutionName = Setting::get('institution_name', 'Pesantren Darul Ilmi');
        $theme = Setting::get('theme', 'emerald');
        $logo = Setting::get('logo', '');

        return view('settings.index', compact('institutionName', 'theme', 'logo'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'institution_name' => 'required|string|max:255',
            'theme' => 'required|string|in:emerald,ocean,sunset,purple,rose,amber',
        ]);

        Setting::set('institution_name', $request->institution_name);
        Setting::set('theme', $request->theme);

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');
            Setting::set('logo', $path);
        }

        return redirect()->route('settings.index')->with('success', 'Pengaturan berhasil disimpan.');
    }
}
