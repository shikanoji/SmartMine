@extends('layouts.app')
@section('content')
     
    <div class="container" style="padding-top:80px;"> 
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="/user/index">Danh sách người dùng</a></li>
            <li class="breadcrumb-item active" aria-current="page">Đổi mật khẩu</li>
            </ol>
        </nav>
        <div class="row row-item" style="text-align:center;display:{{ isset($message)? "block" : "none" }}">
        <span class="badge {{isset($message)? ($message == 'Đổi mật khẩu thành công'? 'badge-success' : 'badge-danger') : "" }} ">{{isset($message)? $message : "" }}</span>
    </div>
    <form method="POST" action="/user/updateUserPassword">
        {{csrf_field()}}
         {!! Form::hidden('user_id', $user->id) !!}
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="row row-item">
                    <h3>Tên người dùng <span class="redtext">{{$user->name}}</span></h3>
                </div>
                <div class="row row-item">
                    <input class="form-control" type="password" name="newPassword" placeholder="Nhập password mới" required>
                </div>
                <div class="row row-item">
                    <input class="form-control" type="password" name="confirmPassword" placeholder="Xác nhận password mới" required>
                </div>
                <div class="row row-item justify-content-center">
                    <button type="submit" class="btn btn-info">Đổi mật khẩu</button>
                </div>
            </div>
        </div>
    </form>
    </div>
    
    
@endsection
