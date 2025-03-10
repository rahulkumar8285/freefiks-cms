<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


class CheckUserLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if(!Session::get('loginId')){
            return redirect('login');
        }

        $roleId = Session::get('roleId');


        if ($request->ajax() || $request->is('/') || $roleId  == 1) {
            return $next($request);
        }


        $route = Route::currentRouteName();


        $result =  DB::table('permissions')
                  ->where('role_id', $roleId)
                  ->where('submenu_url', $route)
                  ->count();

        if($result == 0){
            return redirect('unauthorized');
        }
       

        return $next($request);
    }
}
