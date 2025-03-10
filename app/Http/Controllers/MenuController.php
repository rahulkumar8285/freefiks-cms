<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::orderBy('id', 'desc')->paginate(10);
        return view('menus.index', compact('menus'));
    }

    public function create()
    {
        return view('menus.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'url' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }

        $menu = new Menu();
        $menu->name = $request->name;
        $menu->url = $request->url;
        $menu->save();

        return response()->json(['success' => true, 'message' => 'Menu created successfully.', 'redirect' => url('menus')]);
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail(Crypt::decrypt($id));
        return view('menus.edit', compact('menu'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'url' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }

        $menu = Menu::findOrFail($id);
        $menu->name = $request->name;
        $menu->url = $request->url;
        $menu->save();

        return response()->json(['success' => true, 'message' => 'Menu updated successfully.', 'redirect' => url('menus')]);
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail(Crypt::decrypt($id));
        $menu->delete();
        return redirect()->route('menus.index')->with('success', 'Menu deleted successfully.');
    }

    public function view($id)
    {
        $menu = Menu::findOrFail(Crypt::decrypt($id));
        return view('menus.view', compact('menu'));
    }
}
