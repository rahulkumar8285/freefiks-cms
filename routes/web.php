<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SubMenuController;
use App\Http\Controllers\PermissionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Route::controller(AuthenController::class)->group(function(){
//     Route::get('/registration','registration')->middleware('alreadyLoggedIn');
//     Route::post('/registration-user','registerUser')->name('register-user');
//     Route::get('/login','login')->middleware('alreadyLoggedIn');
//     Route::post('/login-user','loginUser')->name('login-user');
//     Route::get('/','dashboard')->middleware('isLoggedIn');
// });


Route::get('login',[AuthenController::class,'login'])->name('login');
Route::post('loginAuth',[AuthenController::class,'loginUser'])->name('login-user');

Route::middleware(['CheckUserLogin'])->group(function () {
    Route::get('/',[AuthenController::class,'dashboard'])->name('dashboard');
    Route::get('/users',[AuthenController::class,'userIndex'])->name('users');
    Route::get('/user-create',[AuthenController::class,'registration'])->name('registration');
    Route::post('/user-create',[AuthenController::class,'registerUser'])->name('register-user');
    Route::get('users/edit/{id}', [AuthenController::class, 'editUser'])->name('users.edit');
    Route::post('users/update/{id}', [AuthenController::class, 'updateUser'])->name('users.update');
    Route::get('users/delete/{id}', [AuthenController::class, 'deleteUser'])->name('users.delete');
   

    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
    Route::post('/roles/update/{id}', [RoleController::class, 'update'])->name('roles.update');
    
    // Ticket routes
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('/tickets/view/{id}', [TicketController::class, 'view'])->name('tickets.view');
    Route::get('/tickets/edit/{id}', [TicketController::class, 'edit'])->name('tickets.edit');
    Route::post('/tickets/update/{id}', [TicketController::class, 'update'])->name('tickets.update');
    Route::get('/tickets/delete/{id}', [TicketController::class, 'destroy'])->name('tickets.delete');
    Route::post('/tickets/changeStatus/{id}', [TicketController::class, 'changeStatus'])->name('tickets.changeStatus');

    
    // Menu routes
    Route::get('/menus', [MenuController::class, 'index'])->name('menus.index');
    Route::get('/menus/create', [MenuController::class, 'create'])->name('menus.create');
    Route::post('/menus', [MenuController::class, 'store'])->name('menus.store');
    Route::get('/menus/view/{id}', [MenuController::class, 'view'])->name('menus.view');
    Route::get('/menus/edit/{id}', [MenuController::class, 'edit'])->name('menus.edit');
    Route::post('/menus/update/{id}', [MenuController::class, 'update'])->name('menus.update');
    Route::get('/menus/delete/{id}', [MenuController::class, 'destroy'])->name('menus.delete');
 
    // Sub-menu routes
    Route::get('/submenus', [SubMenuController::class, 'index'])->name('submenus.index');
    Route::get('/submenus/create', [SubMenuController::class, 'create'])->name('submenus.create');
    Route::post('/submenus', [SubMenuController::class, 'store'])->name('submenus.store');
    Route::get('/submenus/view/{id}', [SubMenuController::class, 'view'])->name('submenus.view');
    Route::get('/submenus/edit/{id}', [SubMenuController::class, 'edit'])->name('submenus.edit');
    Route::post('/submenus/update/{id}', [SubMenuController::class, 'update'])->name('submenus.update');
    Route::get('/submenus/delete/{id}', [SubMenuController::class, 'destroy'])->name('submenus.delete');

    // Permission routes
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
    Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store');
    Route::get('/permissions/edit/{id}', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::post('/permissions/update/{id}', [PermissionController::class, 'update'])->name('permissions.update');
    Route::get('/permissions/delete/{id}', [PermissionController::class, 'destroy'])->name('permissions.delete');


    
});

Route::get('/logout',[AuthenController::class,'logout'])->name('logout');
Route::get('/unauthorized',[AuthenController::class,'unauthorized'])->name('unauthorized');


