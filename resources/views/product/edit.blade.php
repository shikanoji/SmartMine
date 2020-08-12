@extends('layouts.app')
@section('css')
    
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="/product/index" >Sản phẩm</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sửa thông tin</li>
        </ol>
    </nav>
    <div class="justify-content-center" style="width:100%">
            <form method="POST" action="/product/update/{{$product->id}}">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="row-item gray-bg round-corner">
                            <label>Thông tin sản phẩm</label>
                        </div>
                        <div class="row-item">
                            <input class="form-control" type="text" placeholder="Nhập tên" name="name" value="{{$product->name}}" required>
                        </div>
                    </div>
                </div>
                <div class="row-item">
                    <button type="submit" class="btn btn-info">Cập nhật</button>
                    @if ($product->status == "1")
                    <button class="btn btn-warning" style="display:none;">
                        <a onclick="return confirm('Khoá sản phẩm ' + {{$product->name}} + ' ?')" href="/product/lock/{{$product->id}}" style="color:white;">
                            Khoá sản phẩm
                        </a> 
                    </button>
                    @else 
                    <button class="btn btn-success" style="display:none;">
                        <a onclick="return confirm('Mở khoá sản phẩm ' + {{$product->name}} + ' ?')" href="/product/lock/{{$product->id}}" style="color:white;">
                            Khoá sản phẩm
                        </a> 
                    </button>
                    @endif
                    <button class="btn btn-danger" style="display:none;">
                        <a onclick="return confirm('Xoá sản phẩm ' + {{$product->name}} + ' ?')" href="/product/remove/{{$product->id}}" style="color:white;">
                            Khoá sản phẩm
                        </a> 
                    </button>
                </div>
            </form>
    </div>
@endsection
