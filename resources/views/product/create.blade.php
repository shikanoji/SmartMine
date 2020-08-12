@extends('layouts.app')
@section('css')
    
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="/product/list">Sản phẩm</a></li>
            <li class="breadcrumb-item active" aria-current="page">Thêm mới</li>
        </ol>
    </nav>
    <div class="justify-content-center" style="width:100%">
            
            <form method="POST" action="/product/create">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="row-item gray-bg round-corner" style="text-align: center">
                            <label>Nhập thông tin sản phẩm</label>
                        </div>
                        <div class="row-item" style="display:{{ $warning == 'none' ? "none" : "block" }}">
                            <span class="badge badge-danger">{{$warning}}</span>
                        </div>
                        <div class="row-item">
                            <input class="form-control" type="text" name="name" placeholder="Nhập tên" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        
                    </div>
                </div>               
                <div class="row-item">
                    <button type="submit" class="btn btn-info">Tạo sản phẩm</button>
                </div>
            </form>
    </div>
    
@endsection
