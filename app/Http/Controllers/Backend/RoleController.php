<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use DB;

class RoleController extends Controller
{
    public function AllPermission()
    {
        $permissions = Permission::latest()->get();
        return view('backend.page.permission.all_permission', compact('permissions'));
    } // End Method

    public function AddPermission()
    {

        return view('backend.page.permission.add_permission');
    }// End Method

    public function StorePermission(Request $request)
    {

        $permission = Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notification = array(
            'message' => 'Permission Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.permission')->with($notification);

    } // End Method 

    public function EditPermission($id)
    {

        $permission = Permission::find($id);

        return view('backend.page.permission.edit_permission', compact('permission'));
    }// End Method

    public function UpdatePermission(Request $request)
    {

        $per_id = $request->id;

        Permission::find($per_id)->update([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notification = array(
            'message' => 'Permission Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.permission')->with($notification);

    } // End Method 

    public function DeletePermission($id)
    {

        Permission::find($id)->delete();
        $notification = array(
            'message' => 'Permission Deleted Successfully',
            'alert-type' => 'success'
        );


        return redirect()->back()->with($notification);
    }// End Method

    /////////////////////// All Roles Method ///////////////////////

    public function AllRoles()
    {

        $roles = Role::latest()->get();
        return view('backend.page.roles.all_roles', compact('roles'));

    }// End Method

    public function AddRoles()
    {
        return view('backend.page.roles.add_roles');
    }// End Method

    public function StoreRoles(Request $request)
    {

        Role::create([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => 'Role Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.roles')->with($notification);

    }// End Method 

    public function EditRoles($id)
    {

        $roles = Role::find($id);
        return view('backend.page.roles.edit_roles', compact('roles'));
    }// End Method 



    public function UpdateRoles(Request $request)
    {

        $role_id = $request->id;

        Role::find($role_id)->update([
            'name' => $request->name,

        ]);

        $notification = array(
            'message' => 'Roles Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.roles')->with($notification);

    } // End Method 


    public function DeleteRoles($id)
    {

        Role::find($id)->delete();
        $notification = array(
            'message' => 'Roles Deleted Successfully',
            'alert-type' => 'success'
        );


        return redirect()->back()->with($notification);
    }// End Method

    public function ImportPermission()
    {
        return view('backend.page.permission.import_permission');
    }// End Method 


    public function AddRolesPermission()
    {

        $roles = Role::all();
        $permission = Permission::all();
        $permission_groups = User::getpermissionGroups();
        return view('backend.page.rolesetup.add_roles_permission', compact('roles', 'permission', 'permission_groups'));


    }

    public function RolePermissionStore(Request $request)
    {

        $data = array();
        $permissions = $request->permission;

        foreach ($permissions as $key => $item) {
            $data['role_id'] = $request->role_id;
            $data['permission_id'] = $item;

            DB::table('role_has_permissions')->insert($data);
        } // End Foreach

        $notification = array(
            'message' => 'Roles Permission Added Successfully',
            'alert-type' => 'success'
        );


        return redirect()->route('all.roles.permission')->with($notification);
    }// End Method 

    public function AllRolePermission()
    {

        $roles = Role::all();
        return view('backend.page.rolesetup.all_roles_permission', compact('roles'));

    }// End Method 

    public function AdminEditRoles($id)
    {

        $role = Role::find($id);
        $permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();
        return view('backend.page.rolesetup.edit_roles_permission', compact('role', 'permissions', 'permission_groups'));

    }// End Method 

    public function AdminRolesUpdate(Request $request, $id)
    {
        $role = Role::find($id);
        $permissions = $request->permission;

        // Convert permission IDs from strings to integers
        $permissions = collect($permissions)->map(fn($val) => (int) $val);

        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
        }

        $notification = array(
            'message' => 'Role Permission Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.roles.permission')->with($notification);
    }// End Method 
 

    public function AdminDeleteRoles($id){
        $role = Role::find($id);
        if (!is_null($role)) {
            $role->delete();
        }
        $notification = array(
            'message' => 'Role Permission Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

}
