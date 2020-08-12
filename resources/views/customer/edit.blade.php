@extends('layouts.app')
@section('css')
    
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="/customer/list">Khách hàng</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sửa thông tin</li>
        </ol>
    </nav>
    <div class="justify-content-center" style="width:100%">
            <form method="POST" action="/customer/update/{{$customer->id}}">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="row-item gray-bg round-corner">
                            <label>Thông tin khách hàng</label>
                        </div>
                        <div class="row-item">
                            <input class="form-control" type="text" placeholder="Nhập tên" name="name" value="{{$customer->name}}" required>
                        </div>
                        <div class="row-item">
                            <input class="form-control" type="text" placeholder="Nhập sđt" name="phone" value="{{$customer->phone}}" required>
                        </div>
                        <div class="row-item">
                            <input class="form-control" type="text" placeholder="Nhập địa chỉ" name="address" value="{{$customer->address}}" required>
                        </div>
                    </div>
                </div>
                <div class="row-item">
                    <button type="submit" class="btn btn-info">Cập nhật</button>                    
                </div>
            </form>
    </div>
@endsection
