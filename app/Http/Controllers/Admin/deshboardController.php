<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class deshboardController extends Controller
{
    public function index(Request $request)
    {
        $userId = Session::get('user_id');
        $username = User::select('name')->where('id',$userId)->first();
        $user = ['user_name' => $username->name];
        return view('Admin.deshboard')->with(compact('user'));
    }
}
