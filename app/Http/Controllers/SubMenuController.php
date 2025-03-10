<?php

namespace App\Http\Controllers;

use App\Models\SubMenu;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class SubMenuController extends Controller
{
    public function index()
    {
        $subMenus = SubMenu::orderBy('id', 'desc')->paginate(10);
        return view('submenus.index', compact('subMenus'));
    }

    public function create()
    {
        $menus = Menu::all();
        return view('submenus.create', compact('menus'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'url' => 'nullable|string|max:255',
            'menu_id' => 'required|exists:menus,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }

        $subMenu = new SubMenu();
        $subMenu->name = $request->name;
        $subMenu->url = $request->url;
        $subMenu->menu_id = $request->menu_id;
        $subMenu->save();

        return response()->json(['success' => true, 'message' => 'Sub-menu created successfully.', 'redirect' => url('submenus')]);
    }

    public function edit($id)
    {
        $subMenu = SubMenu::findOrFail(Crypt::decrypt($id));
        $menus = Menu::all();

        return view('submenus.edit', compact('subMenu', 'menus'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'url' => 'nullable|string|max:255',
            'menu_id' => 'required|exists:menus,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }

        $subMenu = SubMenu::findOrFail($id);
        $subMenu->name = $request->name;
        $subMenu->url = $request->url;
        $subMenu->menu_id = $request->menu_id;
        $subMenu->save();

        return response()->json(['success' => true, 'message' => 'Sub-menu updated successfully.', 'redirect' => url('submenus')]);
    }

    public function destroy($id)
    {
        $subMenu = SubMenu::findOrFail(Crypt::decrypt($id));
        $subMenu->delete();
        return redirect()->route('submenus.index')->with('success', 'Sub-menu deleted successfully.');
    }

}
