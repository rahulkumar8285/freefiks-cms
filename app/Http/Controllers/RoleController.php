<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Crypt;


class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::paginate(10);
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles|max:255',
            
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }

        $result = Role::create($request->all());

        if ($result) {
            return response()->json(['success' => true, 'message' => 'Data Submit successfully.', 'redirect' => url('roles')]);
        }

    }

    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $role = Role::find($id);
        return view('roles.edit', compact('role'));
    }

    public function update(Request $request, $roleID)
    {
       

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name,' . $roleID . '|max:255',
        ]);



        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }

        
        if (role::where('id', $roleID)->update(['name' => $request->name])) {
            return response()->json(['success' => true, 'message' => 'Role updated successfully.', 'redirect' => url('roles')]);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to update role.']);
        }

    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('roles.index')
                        ->with('success', 'Role deleted successfully.');
    }
}
?>
