@extends('layouts.app')
@section('css')
    
@endsection
@section('content')
    
    <div class="container" style="padding-top:80px;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="/user/index">Người dùng</a></li>
                <li class="breadcrumb-item active" aria-current="page">Chi tiết</li>
            </ol>
        </nav>
            <div class="row" style="padding:15px;">
        <div>
            <button class="btn btn-info"><a style="color:white;" href="/user/changeUserPassword/{{$user->id}}">Đổi mật khẩu</a></button>
        </div>
        <div style="padding-left:10px;">
            <form method="post" action="/user/lock/{{$user->id}}">
                {{csrf_field()}}
                <button type="submit" class="btn btn-warning" >{{($user->status == "1")? "Khoá tài khoản" : "Mở khoá" }}</button>
            </form>
        </div>
              
    </div>
    <div class="portlet-background row">
        <div class="col-md-6 portlet" style="padding-right:10px;">
            <div class="portlet-title gray-bg round-corner">
                <label style="margin-left:0; margin-right:auto;margin-top:5px;">Thông tin cá nhân</label>&nbsp&nbsp<span><a href=""><i class="fa fa-edit"></i></a></span>
            </div>         
            <div class="portlet-body white-background">
                <div class="row row-item">
                    <label class="col-lg-4 col-md-4 col-sm-4 col-4" style="text-align: center">Tên:</label>
                    <label class="col-lg-8 col-md-8 col-sm-8 col-8 greentext" style="text-align: center">{{$user->name}}</label>
                </div>
                <div class="row row-item">
                    <label class="col-lg-4 col-md-4 col-sm-4 col-4" style="text-align: center">Vai trò:</label>
                    <label class="col-lg-8 col-md-8 col-sm-8 col-8 greentext" style="text-align: center"><bold>{{$user->getRole()}}</bold></label>
                </div>
            </div>      
        </div>
        <div class="col-md-6 portlet">
            <div class="portlet-title gray-bg round-corner">
                <label style="margin-left:0; margin-right:auto;margin-top:5px;">Tình trạng</label>
            </div> 
            <div class="portlet-body white-background">
                <div class="row row-item">
                      <label class="col-lg-6 col-md-6 col-sm-6 col-6" style="text-align: center">Tình trạng tài khoản</label>
                      <label class="col-lg-6 col-md-6 col-sm-6 col-6" style="text-align: center">@if ($user->status == "1")  <span class="greentext">Đang hoạt động</span>  @else <span class="redtext">Đang khoá</span> @endif</label>            
                </div>
            </div>
        </div>
    </div>
    </div>
    
@endsection
