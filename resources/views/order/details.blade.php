@extends('layouts.app')
@section('content')
    <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="/order/index">Lịch sử giao dịch</a></li>
                <li class="breadcrumb-item active" aria-current="page">Chi tiết giao dịch</li>
            </ol>
    </nav>
    <div class="row" style="text-align:center;">
        <div class="col-12 col-md-6 col-lg-6">
            <div class="row row-item">
                <div class="col-6 col-md-6 col-lg-6">
                    <label>Ngày đặt</label>
                </div>
                <div class="col-6 col-md-6 col-lg-6">
                <label class="greentext">{{ date('d-m-Y', strtotime($order->date)) }}</label>
                </div>
            </div>
            <div class="row row-item">
                <div class="col-6 col-md-6 col-lg-6">
                    <label>Khách hàng</label>
                </div>
                <div class="col-6 col-md-6 col-lg-6">
                <label class="greentext">{{$order->customer->name}}</label>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-6">
            <div class="row row-item">
                <div class="col-6 col-md-6 col-lg-6">
                    <label>Sản phẩm</label>
                </div>
                <div class="col-6 col-md-6 col-lg-6">
                    <label class="greentext"> {{$order->amount}} {{$order->unit}} {{$order->product->name}}</label>
                </div>
            </div>
            <div class="row row-item">
                <div class="col-6 col-md-6 col-lg-6">
                    <label>Thành tiền</label>
                </div>
                <div class="col-6 col-md-6 col-lg-6">
                    <label class="greentext">{{$order->charge}}</label>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center" style="width:100%;padding:20px; display:{{Auth::user()->hasAdminPermission()? '' : 'none'}}">
        <div>
            <button class="btn btn-danger"><a style="color:white;" href="/order/remove/{{$order->id}}">Huỷ giao dịch</a></button>    
        </div> 
        
    </div>
@endsection