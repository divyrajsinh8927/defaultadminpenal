<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Resources\Slim;
use App\Http\Resources\uploadFile;
use App\Http\Resources\SlimStatus;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Session as FacadesSession;
use Symfony\Component\HttpFoundation\Session\Session as SessionSession;
use Symfony\Component\HttpFoundation\Session\SessionFactory;

class SystemSettingController extends Controller
{
    public function index()
    {
        $userdata = User::select('id', 'name', 'email', 'mobile_no')->where('id', FacadesSession::get('user_id'))->first();
        return view('Admin.system_setting')->with(compact('userdata'));
    }

    public function system_setting(Request $request)
    {
        Setting::where('setting_name', '=', 'project_name')->update([
            'setting_value' => $request->project_name,
            'updated_at' => Carbon::now()
        ]);

        Setting::where('setting_name', '=', 'theme')->update([
            'setting_value' => $request->project_theme,
            'updated_at' => Carbon::now()
        ]);

        session()->put('project_name', $request->project_name);
        session()->put('theme', $request->project_theme);

        return response()->json(['success' => 'Theme Updated.']);
    }

    public function set_project_logo()
    {
        try {
            $images = Slim::getImages();
        } catch (Exception $e) {

            // Possible solutions
            // ----------
            // Make sure you're running PHP version 5.6 or higher

            Slim::outputJSON(array(
                'status' => SlimStatus::FAILURE,
                'message' => 'Unknown'
            ));

            return;
        }

        // No image found under the supplied input name

        $response = uploadFile::uploadImage($images, 'media/project_logos/');

        // Return results as JSON String

        Setting::where('setting_name', '=', 'project_logo')->update([
            'setting_value' => $response['file'],
            'updated_at' => Carbon::now()
        ]);

        $settings = Setting::where('setting_name', '=', 'project_logo')->first()->toArray();
        FacadesSession::put('project_logo', $response['file']);

        Slim::outputJSON($response);
        // return redirect()->back()->with(['profile_message_type' => 'success'])->with(['profile_message_data' => 'Profile Image Uploaded']);

    }

    public function set_app_logo()
    {
        try {
            $images = Slim::getImages();
        } catch (Exception $e) {

            // Possible solutions
            // ----------
            // Make sure you're running PHP version 5.6 or higher

            Slim::outputJSON(array(
                'status' => SlimStatus::FAILURE,
                'message' => 'Unknown'
            ));

            return;
        }


        $response = uploadFile::uploadImage($images, 'media/app_icon/');


        Setting::where('setting_name', '=', 'app_logo')->update([
            'setting_value' => $response['file'],
            'updated_at' => Carbon::now()
        ]);
        $settings = Setting::where('setting_name', '=', 'app_logo')->first()->toArray();
        FacadesSession::put('app_icon', $settings['setting_value']);

        Slim::outputJSON($response);
        // return redirect()->back()->with(['profile_message_type' => 'success'])->with(['profile_message_data' => 'Profile Image Uploaded']);

    }
}
