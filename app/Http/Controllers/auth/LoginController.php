<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $settings = Setting::where('setting_name', '=', 'app_logo')->first()->toArray();
        $project_logo_settings = Setting::where('setting_name', '=', 'project_logo')->first()->toArray();
        $theme_settings = Setting::where('setting_name', '=', 'theme')->first()->toArray();

        $Admin = User::select('id', 'name', 'user_image', 'password', 'mobile_no')->where('email', '=', $request->email)->first();
        if ($Admin) {
            if (Hash::check($request->password, $Admin->password)) {
                $request->session()->put('user_id', $Admin->id);
                $request->session()->put('user_name', $Admin->name);
                $request->session()->put('user_image', $Admin->user_image);
                $request->session()->put('project_logo', $project_logo_settings['setting_value']);
                $request->session()->put('app_icon', $settings['setting_value']);
                $request->session()->put('theme', $theme_settings['setting_value']);
                $request->session()->put('mobile_number', $Admin->mobile_no);
                Auth::login($Admin);
                return $this->authenticated($request, $Admin);
            }
        }


        $credentials = $request->getCredentials();
        $error = ['errormessage' => 'Wrong Email Or Password'];

        if (!Auth::validate($credentials)) :
            return view('auth.login')->with(compact('error'));
        endif;



        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        $userId = User::select('id', 'name', 'user_image', 'mobile_no')->where('email', $credentials['email'])->first();


        $request->session()->put('user_id', $user->id);
        $request->session()->put('user_name', $user->name);
        $request->session()->put('user_image', $userId->user_image);
        $request->session()->put('project_logo', $project_logo_settings['setting_value']);
        $request->session()->put('app_icon', $settings['setting_value']);
        $request->session()->put('theme', $theme_settings['setting_value']);
        $request->session()->put('mobile_number', $user->mobile_no);


        Auth::login($user);

        return $this->authenticated($request, $user);
    }

    protected function authenticated(Request $request, $user)
    {
        return redirect()->intended();
    }
    public function logout()
    {
        Session::flush();

        Auth::logout();

        return redirect('login');
    }
}
