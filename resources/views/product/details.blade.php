@extends('layouts.app')
@section('css')
    
@endsection
@section('content')
    <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="/product/index">Sản phẩm</a></li>
                <li class="breadcrumb-item active" aria-current="page">Chi tiết</li>
            </ol>
    </nav>
    
    <div class="portlet-background row">
        <div class="col-md-6 portlet" style="padding-right:10px;">
            <div class="portlet-title gray-bg round-corner">
                <label style="margin-left:0; margin-right:auto;margin-top:5px;">Thông tin</label>&nbsp&nbsp<span><a href="/product/edit/{{$product->id}}"><i class="fa fa-edit"></i></a></span>
            </div>         
            <div class="portlet-body">
                <div class="row row-item">
                    <label class="col-lg-4 col-md-4 col-sm-4 col-4" style="text-align: center">Tên:</label>
                    <label class="col-lg-8 col-md-8 col-sm-8 col-8 greentext" style="text-align: center">{{$product->name}}</label>
                </div>
                <div class="row row-item justify-co">
                    <label class="col-lg-4 col-md-4 col-sm-4 col-4" style="text-align: center">Tình trạng:</label>
                    @if ($product->status == "1")
                    <label class="col-lg-8 col-md-8 col-sm-8 col-8 greentext" style="text-align: center"><bold>Đang hoạt động</bold></label>
                    @else
                    <label class="col-lg-8 col-md-8 col-sm-8 col-8 redtext" style="text-align: center"><bold>Đang bị khoá</bold></label>
                    @endif
                </div>
                
            </div>      
        </div>
        <div class="col-md-6 portlet" style="">
            <div class="portlet-title gray-bg round-corner">
                <label style="margin-left:0; margin-right:auto;margin-top:5px;">Thông số</label>
            </div>         
            <div class="portlet-body">
                <div class="row row-item">
                    <label class="col-lg-4 col-md-4 col-sm-4 col-4" style="text-align: center">Tổng doanh thu:</label>
                    <label class="col-lg-8 col-md-8 col-sm-8 col-8 greentext" style="text-align: center">{{number_format($product->getTotalOrderValue(),  0, ',', '.')}}</label>
                </div>
                
            </div>      
        </div>
    </div>
    <div class="row justify-content-center" style="padding:15px;">
        <div>
            <form method="post" action="/product/lock/{{$product->id}}">
                {{csrf_field()}}
                <button type="submit" class="btn btn-warning" >{{($product->status == "1")? "Khoá sản phẩm" : "Mở khoá sản phẩm" }}</button>
            </form>    
        </div>      
    </div>
@endsection
