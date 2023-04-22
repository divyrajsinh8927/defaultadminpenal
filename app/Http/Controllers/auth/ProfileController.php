<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Resources\Slim;
use App\Http\Resources\uploadFile;
use App\Http\Resources\SlimStatus;
use Exception;

class ProfileController extends Controller
{
    public function index()
    {
        $userdata = User::select('id', 'name', 'email', 'mobile_no')->where('id', Session::get('user_id'))->first();
        return view('auth.profiile')->with(compact('userdata'));
    }

    public function updateEmail(Request $request)
    {
        if ($request->email == '') {
            return redirect()->back()->with(['email_message_type' => 'danger'])->with(['email_message_data' => 'Please Input Email']);
        }
        $user = User::select('email')->where('id', Session::get('user_id'))->first();
        if ($request->email == $user->email) {
            return redirect()->back();
        }
        User::findOrFail(Session::get('user_id'))->update([
            'email' => $request->email,
            'update_at' => Carbon::now()
        ]);
        // return redirect()->route('profile','$message')->with(['success' => 'Updated']);
        return redirect()->back()->with(['email_message_type' => 'success'])->with(['email_message_data' => 'Email Updated Successfully!']);
    }
    public function updatePassword(Request $request)
    {
        if ($request->old_password == '') {
            return redirect()->back()->with(['password_message_type' => 'danger'])->with(['password_message_data' => 'Please Input The Old Password']);
        }
        $user = User::select('password')->where('id', Session::get('user_id'))->first();
        if (!$user || !Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->with(['password_message_type' => 'danger'])->with(['password_message_data' => 'Wrong Old Password']);
        }
        if ($request->new_password != $request->confirm_password) {
            return redirect()->back()->with(['password_message_type' => 'danger'])->with(['password_message_data' => 'Password And Confirmed Password Are Not Same']);
        }
        User::findOrFail(Session::get('user_id'))->update([
            'password' => Hash::make($request->new_password),
            'update_at' => Carbon::now()
        ]);
        return redirect()->back()->with(['password_message_type' => 'success'])->with(['password_message_data' => 'Password Updated Successfully!']);
    }

    public function update_mobile_number(Request $request)
    {
        if ($request->new_mobile_number == '') {
            return redirect()->back()->with(['number_message_type' => 'danger'])->with(['number_message_data' => 'Please Input number']);
        }
        User::findOrFail(Session::get('user_id'))->update([
            'mobile_no' => $request->new_mobile_number,
            'update_at' => Carbon::now()
        ]);
        Session::put('mobile_number', $request->new_mobile_number);
        return redirect()->back()->with(['number_message_type' => 'success'])->with(['number_message_data' => 'Number Updated Successfully!']);
    }

    public function update_profile_picture(Request $request)
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

        // Return results as JSON String

        User::where('id', '=', Session::get('user_id'))->update([
            'user_image' => $response['file']
        ]);
        Session::put('user_image', $response['file']);
        Slim::outputJSON($response);
        // return redirect()->back()->with(['profile_message_type' => 'success'])->with(['profile_message_data' => 'Profile Image Uploaded']);

    }
}
