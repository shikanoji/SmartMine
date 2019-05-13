@extends('layouts.app')
@section('css')
    
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="/user/index">Người dùng</a></li>
            <li class="breadcrumb-item active" aria-current="page">Thêm mới</li>
        </ol>
    </nav>
    <div class="justify-content-center" style="width:100%">
            
            <form method="POST" action="/user/store">
                {{csrf_field()}}
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="row-item gray-bg round-corner" style="text-align: center">
                            <label>Nhập thông tin người dùng</label>
                        </div>
                        <div class="row-item" style="display:{{ isset($warning)? "block" : "none" }}">
                            <span class="badge badge-danger">{{isset($warning)? $warning : "" }}</span>
                        </div>
                        <div class="row-item">
                            <input class="form-control" type="text" name="name" placeholder="Nhập tên" required>
                        </div>
                        <div class="row-item">
                            <input class="form-control" type="email" name="email" placeholder="Nhập email" required>
                        </div>
                        <div class="row-item">
                            <input class="form-control" type="password" name="password" placeholder="Nhập password" required>
                        </div>
                        <div class="row row-item">
                            <div class="col-lg-4 col-sm-4 col-md-4 col-12" style="text-align: center;">
                                <label for="order-type">Loại </label> 
                            </div>
                            <div class="col-lg-8 col-sm-8 col-md-8 col-12">
                                <select class="form-control selectpicker" name="role">
                                    <option value="ROLE_MEMBER">Người dùng thường</option>
                                    <option value="ROLE_ADMIN">Quản trị viên</option>
                                </select>
                            </div>                 
                        </div>
                    </div>
                </div>                                
                <div class="row row-item justify-content-center">
                    <button type="submit" class="btn btn-info">Tạo khách hàng</button>
                </div>
            </form>
    </div>
    
@endsection
