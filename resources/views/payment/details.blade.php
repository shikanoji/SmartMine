@extends('layouts.app')
@section('content')
    <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="/payment/index">Lịch sử thanh toán</a></li>
                <li class="breadcrumb-item active" aria-current="page">Chi tiết thanh toán</li>
            </ol>
    </nav>
    <div class="row" style="text-align:center;">
        <div class="col-12 col-md-6 col-lg-6">
            <div class="row row-item">
                <div class="col-6 col-md-6 col-lg-6">
                    <label>Ngày đặt</label>
                </div>
                <div class="col-6 col-md-6 col-lg-6">
                <label class="greentext">{{ date('d-m-Y', strtotime($payment->date)) }}</label>
                </div>
            </div>
            <div class="row row-item">
                <div class="col-6 col-md-6 col-lg-6">
                    <label>Khách hàng</label>
                </div>
                <div class="col-6 col-md-6 col-lg-6">
                <label class="greentext">{{$payment->customer->name}}</label>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-6">
            <div class="row row-item">
                <div class="col-6 col-md-6 col-lg-6">
                    <label>Thành tiền</label>
                </div>
                <div class="col-6 col-md-6 col-lg-6">
                    <label class="greentext">{{number_format($payment->amount,0,',','.')}}</label>
                </div>
            </div>
            <div class="row row-item">
                <div class="col-6 col-md-6 col-lg-6">
                    <label>Ghi chú</label>
                </div>
                <div class="col-6 col-md-6 col-lg-6">
                    <label class="greentext">{{$payment->note}}</label>
                </div>
            </div>
            <div class="row row-item">
                <div class="col-6 col-md-6 col-lg-6">
                    <label>Người phụ trách</label>
                </div>
                <div class="col-6 col-md-6 col-lg-6">
                    <label class="greentext">{{$payment->user->name}}</label>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center" style="width:100%;padding:20px;">
        <div>
            <button class="btn btn-danger"><a style="color:white;" href="/payment/remove/{{$payment->id}}">Huỷ thanh toán</a></button>    
        </div> 
        
    </div>
@endsection