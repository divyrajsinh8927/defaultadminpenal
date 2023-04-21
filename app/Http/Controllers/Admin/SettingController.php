<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('Admin.setting');
    }

    public function set_theme(Request $request)
    {
        Setting::where('setting_name', '=', 'theme')->update([
            'setting_value' => $request->theme,
            'updated_at' => Carbon::now()
        ]);
        return response()->json(['success' => 'Theme Updated.']);
    }
    public function set_app_name(Request $request)
    {
        Setting::where('setting_name', '=', 'app_name')->update([
            'setting_value' => $request->app_name,
            'updated_at' => Carbon::now()
        ]);
        return response()->json(['success' => 'Theme Updated.']);
    }
}
