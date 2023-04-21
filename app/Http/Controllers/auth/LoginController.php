<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->getCredentials();
        $error = ['errormessage' => 'Wrong Email Or Password'];

        if(!Auth::validate($credentials)):
            return view('auth.login')->with(compact('error'));
        endif;

        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        $userId = User::select('id','name','user_image','mobile_no')->where('email',$credentials['email'])->first();
        $settings = Setting::where('setting_name','=','app_logo')->first()->toArray();

        $request->session()->put('user_id',$user->id);
        $request->session()->put('user_name',$user->name);
        $request->session()->put('user_image',$userId->user_image);
        $request->session()->put('app_icon',$settings['setting_value']);
        $request->session()->put('mobile_number',$user->mobile_no);

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


