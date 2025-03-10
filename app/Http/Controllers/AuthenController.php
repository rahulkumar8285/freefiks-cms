<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\TicketModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Crypt;
use Illuminate\Support\Facades\Mail;

class AuthenController extends Controller
{
    //Registration

    public function  userIndex()
    {
        $users = User::select('users.*','roles.name as roleName')->orderBy('id', 'desc')
                            ->join('roles','roles.id','users.role')
                            ->where('users.is_delete',0)
                            ->paginate(10);
        return view('users.index',compact('users'));
    }

    public function registration()
    {
        $roles =  Role::all();
        return view('users.add', compact('roles'));
    }
    public function registerUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users', 'regex:/^[a-zA-Z0-9._%+-]+@fastfiks\.com$/'],
            'phone' => 'required|digits:10|numeric',
            'password' => 'required|min:8|max:12',
            'confirm_password' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }

        try {
            \DB::beginTransaction();

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->role = $request->role;
            $user->address = $request->address;

            $password = $request->password;

            $user->password = Hash::make($request->password);
            $user->passwodView = $password;
            $user->save();

            Mail::send('emails.registration', ['user' => $user, 'password' => $password,
                                              'login_url' => url('/login') , 
                                              'logo_url'=> asset('assets/images/logo.png') 
                                            ], function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Registration Successful');
            });
            


            \DB::commit();

            return response()->json(['success' => true, 'message' => 'You have registered successfully.', 'redirect' => url('users')]);
        } catch (\Exception $e) {
            \DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $e->getMessage()]);
        }

    }

    public function editUser($id)
    {
        $id =  Crypt::decrypt($id);
        $user = User::find($id);
        $roles =  Role::all();
        return view('users.edit', compact('user','roles'));
    }

    public function updateUser(Request $request , $id)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required|digits:10|numeric',
            // 'password' => 'nullable|min:8|max:12',
            // 'confirm_password' => 'nullable|same:password'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->role = $request->role;
        $user->address = $request->address;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $result = $user->save();
        if ($result) {
            return response()->json(['success' => true, 'message' => 'User updated successfully.', 'redirect' => url('users')]);
        } else {
            return response()->json(['success' => false, 'message' => 'Something went wrong!']);
        }
    }

    ////Login
    public function login()
    {
        if(Session::get('loginId')){
            return redirect('/');
        }
        return view('auth.login');
    }
    public function loginUser(Request $request)
    {
        $validator = $request->validate([            
            'email'=>'required|email',
            'password'=>'required|min:8|max:12'
        ]);



        $userData = User::where('email',$request->email)->where('is_delete',0)->first();

        if($userData){

            if(trim($request->password) == $userData->passwodView){
                $request->session()->put('loginId', $userData->id);
                $request->session()->put('roleId', $userData->role);
                $request->session()->put('name', $userData->name);
                return response()->json(['success' => true, 'message' => 'Login successful', 'redirect' => url('/')]);
            } else {
                return response()->json(['success' => false, 'message' => 'Password not match!']);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'This email is not registered.']);
        }        
    }
    //// Dashboard
    public function dashboard()
    {
        // return "Welcome to your dashabord.";
        $data = array();
        if(Session::has('loginId')){
            $data = User::where('id','=',Session::get('loginId'))->first();
        }

        $usersCount = User::where('is_delete',0)->count();
        $ticketCount = TicketModel::count();

        return view('welcome',compact('data', 'usersCount', 'ticketCount'));
    }
    ///Logout
    public function logout()
    {
        $data = array();
        if(Session::has('loginId')){
            Session::pull('loginId');
            return redirect('login');
        }
    }


    public function deleteUser($userId){
        $userId =  Crypt::decrypt($userId);
        $user = User::find($userId);
        $user->is_delete = 1;
        $user->save();
        return redirect('users');
    }


    public function unauthorized()
    {
        return view('common.unauthorized');
    }

    


}