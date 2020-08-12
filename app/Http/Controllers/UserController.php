<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Hash;

class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        if (Auth::user()->hasRole('ROLE_ADMIN')) {
            $users = User::all();
            return view('user.index', compact('users'));
        } else {
            abort(404);
        }      
    }

    public function create(){
        if (Auth::user()->hasRole('ROLE_ADMIN')) {
            return view('user.create');
        } else {
            abort(404);
        } 
    }

    public function store(){
        if (Auth::user()->hasRole('ROLE_ADMIN')) {
            if( User::where('username',request('username'))->exists()){
            $warning = 'Tên đăng nhập bị trùng lặp';
            return view('user.create',compact("warning"));
        } else {
            $user = new User();
            $user->name = request('name');
            $user->username = request('username');
            $user->password = bcrypt(request('password'));
            $user->role = request('role');
            $user->status = "1";
            $user->save();    
        }
        return $this->index();
        } else {
            abort(404);
        } 
    }

    public function changePassword(){
        return view('user.changePassword');
    }

    public function updatePassword(){
        if(Hash::check(request('oldPassword'), Auth::User()->password) == false){
            $message = "Mật khẩu cũ không chính xác";     
        } else if (request('newPassword') != request('confirmPassword')){
            $message = "Mật khẩu xác nhận không chính khớp";
        } else {
            $user = User::where('id', Auth::user()->id)->first();
            $user->password = bcrypt(request('newPassword'));
            $user->save();
            $message = "Đổi mật khẩu thành công";

        }
        return view('user.changePassword', compact('message'));
    }

    public function destroy($id) {
        if (Auth::user()->hasRole('ROLE_ADMIN')) {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect('/user/index');
        } else {
            error('404');
        }      
    }

    public function lock($id) {
        if (Auth::user()->hasRole('ROLE_ADMIN')) {
            $user = User::findOrFail($id);
            if ($user->status == "1") {
                $user->status = "0";
            } else {
                $user->status = "1";
            }     
            $user->save();
            return redirect('/user/index');
        } else {
            error('404');
        }
    }

    public function updateUserPassword() {
        if (Auth::user()->hasRole('ROLE_ADMIN')) {
            $user = User::findOrFail(request('user_id'));
            $user->password = bcrypt(request('newPassword'));
            $user->save();
            $message = "Đổi mật khẩu thành công";
            return view('user.changeUserPassword', compact('message','user'));
        } else {
            abort(404);
        }      
    }

    public function changeUserPassword($id) {
        if (Auth::user()->hasRole('ROLE_ADMIN')) {
            $user = User::findOrFail($id);
            return view('user.changeUserPassword', compact("user"));
        } else {
            abort(404);
        }
    }

    public function details($id){
        if (Auth::user()->hasRole('ROLE_ADMIN')) {
            $user = User::findOrFail($id);
            return view("user.details", compact("user"));
        } else {
            abort(404);
        }    
    }
}
