<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SecuritySetting;

class SecuritySettingsController extends Controller
{
    public function index()
    {
        $settings = SecuritySetting::first();
        return view('admin.settings.security-settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'session_timeout' => 'required|integer|min:1|max:120',
        ]);

        $settings = SecuritySetting::firstOrCreate([]);

        $settings->allow_user_registration = $request->has('allow_user_registration');
        $settings->require_strong_passwords = $request->has('require_strong_passwords');
        $settings->enable_2fa = $request->has('enable_2fa');
        $settings->session_timeout = $request->session_timeout;
        $settings->login_alerts = $request->has('login_alerts');
        $settings->save();

        return redirect()->back()->with('success', 'Security settings updated successfully.');
    }
}

