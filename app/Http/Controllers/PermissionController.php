<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\Menu;
use App\Models\SubMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class PermissionController extends Controller
{
    public function index()
    {
        $permissions = DB::table('permissions')
        ->selectRaw('MAX(permissions.id) as id, permissions.role_id, roles.name as role_name')
        ->join('roles', 'permissions.role_id', '=', 'roles.id')
        ->groupBy('permissions.role_id', 'roles.name')
        ->paginate(10);
       
        return view('permissions.index', compact('permissions'));
    }

    public function create()
    {
        $roles =   Role::all();
        $menus = Menu::with('submenus')->get();
        $submenu = SubMenu::all();
        
        return view('permissions.create' , compact('roles','menus','submenu'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role_id' => 'required|exists:roles,id|integer|unique:permissions,role_id',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }

        $permissions = $request->permissions;
        foreach ($permissions as $permissionItems) {
            $permission = new Permission();
            $permission->role_id = $request->role_id;
            $permission->submenu_url = $permissionItems;
            $permission->save();
        }
        
        return response()->json(['success' => true, 'message' => 'Permission created successfully.', 'redirect' => url('permissions')]);
    }

    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $permission = Permission::where('role_id',$id)->get();
        $roles =   Role::all();
        $menus = Menu::with('submenus')->get();
        $submenu = SubMenu::all();

        return view('permissions.edit', compact('permission','roles','menus','submenu','id'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'role_id' => 'required|exists:roles,id|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }

        Permission::where('role_id', $request->role_id)->delete();
        $permissions = $request->permissions;
        foreach ($permissions as $permissionItems) {
            $permission = new Permission();
            $permission->role_id = $request->role_id;
            $permission->submenu_url = $permissionItems;
            $permission->save();
        }
        
        return response()->json(['success' => true, 'message' => 'Permission updated successfully.', 'redirect' => url('permissions')]);
    }

    public function destroy($id)
    {
        $permission = Permission::findOrFail(Crypt::decrypt($id));
        $permission->delete();
        return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully.');
    }
}
