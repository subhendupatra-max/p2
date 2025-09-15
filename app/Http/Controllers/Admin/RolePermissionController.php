<?php

namespace App\Http\Controllers\Admin;

use App\Traits\UploadAble;
use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Auth;


class RolePermissionController extends BaseController
{
    use UploadAble;
    public function index()
    {
        $data['title'] = "Role";
        // $data['roles'] = Role::whereNotIn('slug', ['super-admin'])->get();
         $data['roles'] = Role::get();
        return view('admin.role_permission.role', $data);
    }

    public function roleAdd(Request $request)
    {
        $id = $request->id ?? NULL;
        if (!empty($id)) {
            $request->validate([
                'name' => 'required|string|unique:roles,name,' . $id,
            ]);
            $message = "Role Updated Successfully";
            $url = route('admin.role.list');
        } else {
            $request->validate([
                'name' => 'required|string|unique:roles,name',
            ]);
            $message = "Role Created Successfully";
        }

        DB::beginTransaction();
        try {
            $postData = [
                "name" => $request->name,
                "slug" => Str::slug($request->name)
            ];
            if($id != null){
                $postData['updated_by'] = Auth::user()->id;
            }else{
                $postData['created_by'] = Auth::user()->id;
            }
            $details = Role::updateOrCreate(['id' => $id], $postData);

              if ($id == null) {
                    // Log Activity
                  activity()
                    ->causedBy(Auth::user())
                    ->withProperties(['ip_address' => request()->ip()])
                    ->log($request->name .': Role Created');
                    // Log Activity
                }else{
                    // Log Activity
                   activity()
                    ->causedBy(Auth::user())
                    ->withProperties(['ip_address' => request()->ip()])
                    ->log($request->name .': Role Updated');
                    // Log Activity
                }

            $url = route('admin.role.permission', $details->uuid);
            DB::Commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return $this->responseJson(false, 500, config('constants.CATCH_ERROR_MSG'), ['Message' => $th->getMessage(), 'File Path' => $th->getFile(), 'Line Number' => $th->getLine()]);
        }
        $data = ['status' => true, 'message' => $message, 'data' => $details ?? null, 'url' => $url];
        return response($data);
    }
    public function rolePermission(Request $request, $id)
    {
        $title = 'Role & Permission';
        $roleData = Role::where('uuid', $request->uuid)->first();
        $permissions = Permission::whereNotIn('group_by', ['role_permissions'])->get()->groupBy('group_by');
        if ($request->post()) {
            $request->validate([
                'permission' => 'required|array',
            ]);
            try {
                $roleData->permissions()->detach();
                $isPermissionAttached = $roleData->givePermissionsTo((array) $request->permission);
                if ($isPermissionAttached) {
                    $roleData->update(['is_active' => 1]);
                    $status = true;
                    $code = 200;
                    $response = [];
                    $message = 'Permission attached successfully';
                }

                // Log Activity
                activity()
                    ->causedBy(Auth::user())
                    ->withProperties(['ip_address' => request()->ip()])
                    ->log('Permission Updated for role: ' . $roleData?->name);
                // Log Activity

            } catch (\Exception $th) {
                $status = false;
                $code = 500;
                $response = ['Message' => $th->getMessage(), 'File Path' => $th->getFile(), 'Line Number' => $th->getLine()];
                $message = config('constants.CATCH_ERROR_MSG');
            }
            $data = ['status' => true, 'message' => $message, 'data' => [], 'url' => route('admin.role.list')];
            return response($data);
        }

        return view('admin.role_permission.permission', compact('permissions', 'roleData', 'title'));
    }

    public function userRolePermission(Request $request)
    {
        $permissions = Permission::whereNotIn('group_by', ['role_permissions'])->get()->groupBy('group_by');
        $user = User::where('uuid', $request->uuid)->first();
        if ($request->post()) {
            $request->validate([
                'permission' => 'required|array',
            ]);
            try {
                $user->permissions()->sync($request->permission);
                $status = true;
                $code = 200;
                $response = [];
                $message = 'Permissions updated successfully for the user.';
            } catch (\Exception $th) {
                $status = false;
                $code = 500;
                $response = ['Message' => $th->getMessage(), 'File Path' => $th->getFile(), 'Line Number' => $th->getLine()];
                $message = config('constants.CATCH_ERROR_MSG');
            }
            $data = ['status' => true, 'message' => $message, 'data' => [], 'url' => route('admin.role.user.list')];
            return response($data);
        }
        $title = 'User Role & Permission';
        $roleData = $user->permissions()->get();

        return view('admin.role_permission.user_permission', compact('permissions', 'roleData', 'user'));
    }
}
