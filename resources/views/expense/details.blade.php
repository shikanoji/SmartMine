@extends('layouts.app')
@section('content')
    <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="/expense/index">Lịch sử thanh toán</a></li>
                <li class="breadcrumb-item active" aria-current="page">Chi tiết chi phí</li>
            </ol>
    </nav>
    <div class="row" style="text-align:center;">
        <div class="col-12 col-md-6 col-lg-6">
            <div class="row row-item">
                <div class="col-6 col-md-6 col-lg-6">
                    <label>Thời gian</label>
                </div>
                <div class="col-6 col-md-6 col-lg-6">
                <label class="greentext">{{ date('d-m-Y', strtotime($expense->date)) }}</label>
                </div>
            </div>
            <div class="row row-item">
                <div class="col-6 col-md-6 col-lg-6">
                    <label>Người phụ trách</label>
                </div>
                <div class="col-6 col-md-6 col-lg-6">
                    <label class="greentext">{{$expense->user->name}}</label>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-6">
            <div class="row row-item">
                <div class="col-6 col-md-6 col-lg-6">
                    <label>Thành tiền</label>
                </div>
                <div class="col-6 col-md-6 col-lg-6">
                    <label class="greentext">{{number_format($expense->amount,0,',','.')}}</label>
                </div>
            </div>
            <div class="row row-item">
                <div class="col-6 col-md-6 col-lg-6">
                    <label>Nội dung</label>
                </div>
                <div class="col-6 col-md-6 col-lg-6">
                    <label class="greentext">{{$expense->content}}</label>
                </div>
            </div>
            
        </div>
    </div>
    <div class="row justify-content-center" style="width:100%;padding:20px;display:{{Auth::user()->hasSalerPermission()? '' : 'none'}}">
        <div>
            <button class="btn btn-danger"><a style="color:white;" href="/expense/remove/{{$expense->id}}">Huỷ chi phí</a></button>    
        </div> 
        
    </div>
@endsection