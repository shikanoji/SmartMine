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
        $users = User::all();
        return view('user.index', compact('users'));
    }

    public function create(){
        return view('user.create');
    }

    public function store(){
        if( User::where('email',request('email'))->exists()){
            $warning = 'Email bị trùng lặp';
            return view('user.create',compact("warning"));
        } else {
            $user = new User();
            $user->name = request('name');
            $user->email = request('email');
            $user->password = bcrypt(request('password'));
            $user->role = request('role');
            $user->save();    
        }
        return $this->index();
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
}
