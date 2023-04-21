<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\role;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserManagementController extends Controller
{
    public function index()
    {
        // $users = User::select('users.id','users.name','users.email','users.mobile_no','role as user_role')->join('roles','roles.id','users.role_id')->where('users.role_id','!=','1')->get();
        return view('Admin.usermanagement');
    }

    public function getUsers(Request $request)
    {

        $length = $request->length;
        $start = $_POST['start'];
        global $search;
        $search = $request->search['value'];
        $draw = $request->draw;

        $orderColumn = $request->order[0]['column'];
        if ($orderColumn == 0)
            $orderColumnName = "users.id";
        elseif ($orderColumn == 1)
            $orderColumnName = "users.name";
        elseif ($orderColumn == 2)
            $orderColumnName = "users.mobile_no";
        else
            $orderColumnName = "users.role_id";

        $order = $request->order[0]['dir'];

        $totalUsers = User::where('is_Delete', 0)->where('users.role_id', '!=', '1')->get()->count();

        $users = User::select('users.id', 'users.name', 'users.email', 'users.mobile_no', 'roles.role as role')
            ->join('roles', 'roles.id', 'users.role_id')->where('users.is_Delete', '=', 0)->where('users.role_id', '!=', '1')->where(function ($query) {
                global $search;
                $query->where('users.name', 'LIKE', '%' . $search . '%')
                    ->orWhere('users.id', 'LIKE', '%' . $search . '%')
                    ->orWhere('users.email', 'LIKE', '%' . $search . '%')
                    ->orWhere('roles.role', 'LIKE', '%' . $search . '%')
                    ->orWhere('users.mobile_no', 'LIKE', '%' . $search . '%');
            })->skip($start)->take($length)
            ->orderBy($orderColumnName, $order)->get();

        $filterdUsers = User::select('users.id', 'users.name', 'users.email', 'users.mobile_no', 'roles.role as role')
            ->join('roles', 'roles.id', 'users.role_id')->where('users.role_id', '!=', '1')->where('users.is_Delete', '=', 0)->where(function ($query) {
                global $search;
                $query->where('users.name', 'LIKE', '%' . $search . '%')
                    ->orWhere('users.id', 'LIKE', '%' . $search . '%')
                    ->orWhere('users.email', 'LIKE', '%' . $search . '%')
                    ->orWhere('roles.role', 'LIKE', '%' . $search . '%')
                    ->orWhere('users.mobile_no', 'LIKE', '%' . $search . '%');
            })->get()->count();

        $displayedUsers = $users->count();

        $res = array(
            "orderColumnName"  => $orderColumnName,
            "order"  => $order,
            "totalUsers" => $totalUsers,
            "displayedUsers" => $displayedUsers,
            "recordsFiltered" => $filterdUsers,
            "draw" => intval($draw),
            "data" => $users
        );
        return response()->json($res);
    }

    public function role_for_option()
    {
        $roles = role::get();
        return response()->json($roles);
    }

    public function add_user(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'txt_name' => 'required',
                'txt_email' => 'required',
                'txt_mobile_number' => 'required',
                'txt_password' => 'required',
                'txt_confirm_password' => 'required|same:txt_password',
                'select_role' => 'required',
            ]);

            if ($validator->fails()) {

                return redirect()->back()->with(['add_form_error_type' => 'danger'])->with(['add_form_error' => $validator->errors()->all()]);
            }

            User::create([
                "name" => $request->txt_name,
                "email" => $request->txt_email,
                "password" => Hash::make($request->txt_password),
                "mobile_no" => $request->txt_mobile_number,
                "role_id" => $request->select_role
            ]);

            return redirect()->back()->with(['add_form_error_type' => 'success'])->with(['add_form_error' => 'User Added Successfuly']);

        } catch (Exception $e) {
            return redirect()->back()->with(['add_form_error_type' => 'danger'])->with(['add_form_error' => $e]);
        }
    }

    public function delete_user(Request $request)
    {
        try {
            User::findOrFail($request->id)->update([
                'is_delete' => 1,
                'updated_at' => Carbon::now(),
            ]);
            return response()->json(['success' => 'Product Deleted successfully.']);
        } catch (Exception $e) {
            return response()->json(['error' => $e]);
        }
    }
}
