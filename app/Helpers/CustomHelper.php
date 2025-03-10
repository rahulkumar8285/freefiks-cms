<?php

if(!function_exists('getMenu')) {
    function getMenu() { 
        $roleId = session('roleId');

        if ($roleId == 1) {
            $menuNames = DB::table('menus')->get();
        } else {
            $menuNames = DB::table('permissions')
            ->select('menus.*')  // Select all menu columns
            ->where('role_id', $roleId)
            ->join('sub_menus', 'permissions.submenu_url', '=', 'sub_menus.url')
            ->join('menus', 'sub_menus.menu_id', '=', 'menus.id') 
            ->groupBy('menus.id', 'menus.name', 'menus.url' , 'menus.created_at' , 'menus.updated_at' )  // Ensure all selected columns are grouped
            ->get();
        }
        return $menuNames;

    }
}

if(!function_exists('getSubMenu')) {
    function getCurrentUrl() { 
        $currentUrl = url()->current();
        return $currentUrl;
    }
}


