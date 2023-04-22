<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\role;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function index()
    {
        return view('Admin.roles');
    }

    public function get_roles(Request $request)
    {

        $length = $request->length;
        $start = $_POST['start'];
        global $search;
        $search = $request->search['value'];
        $draw = $request->draw;

        $orderColumn = $request->order[0]['column'];
        if ($orderColumn == 0)
            $orderColumnName = "id";
        elseif ($orderColumn == 1)
            $orderColumnName = "role";

        $order = $request->order[0]['dir'];

        $total_roles = role::where('is_Delete', 0)->get()->count();

        $roles = role::select('id', 'role')->where('is_Delete', '=', 0)->where(function ($query) {
            global $search;
            $query->where('role', 'LIKE', '%' . $search . '%')
                ->orWhere('id', 'LIKE', '%' . $search . '%');
        })->skip($start)->take($length)
            ->orderBy($orderColumnName, $order)->get();

        $filterd_roles = role::select('id', 'role')->where('is_Delete', '=', 0)->where(function ($query) {
            global $search;
            $query->where('role', 'LIKE', '%' . $search . '%')
                ->orWhere('id', 'LIKE', '%' . $search . '%');
        })->get()->count();

        $displayed_roles = $roles->count();

        $res = array(
            "orderColumnName"  => $orderColumnName,
            "order"  => $order,
            "totalUsers" => $total_roles,
            "displayedUsers" => $displayed_roles,
            "recordsFiltered" => $filterd_roles,
            "draw" => intval($draw),
            "data" => $roles
        );
        return response()->json($res);
    }

    public function add_role(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'txt_role_name' => 'required',
            ]);

            if ($validator->fails()) {

                return ['add_form_error' => $validator->errors()->all()];
            }

            role::create([
                "role" => $request->txt_role_name,
                'created_at' => Carbon::now(),
            ]);

            return "success";
        } catch (Exception $e) {
            return ['add_form_error' => $e];
        }
    }

    public function edit_roles(Request $request)
    {
        $edit_user = role::findOrFail($request->id);
        return response()->json($edit_user);
    }

    public function update_roles(Request $request)
    {
        try {
            $updatevalidator = Validator::make($request->all(), [
                'txt_update_role_id' => 'required',
                'txt_update_role_name' => 'required',
            ]);

            if ($updatevalidator->fails()) {
                return response()->json([
                    'update_error' => $updatevalidator->errors()->all()
                ]);
            }

            role::findOrFail($request->txt_update_role_id)->update([
                'role' => $request->txt_update_role_name,
                'updated_at' => Carbon::now()
            ]);
        } catch (Exception $e) {
            return ['update_error' => $e];
        }
    }

    public function delete_roles(Request $request)
    {
        try {
            role::findOrFail($request->id)->update([
                'is_delete' => 1,
                'updated_at' => Carbon::now(),
            ]);
            return response()->json(['success' => 'Product Deleted successfully.']);
        } catch (Exception $e) {
            return response()->json(['error' => $e]);
        }
    }
}
