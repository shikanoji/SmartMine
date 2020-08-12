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
                    <label class="greentext"></label>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-6">
            <div class="row row-item">
                <div class="col-6 col-md-6 col-lg-6">
                    <label>Mã</label>
                </div>
                <div class="col-6 col-md-6 col-lg-6">
                    <label class="greentext"></label>
                </div>
            </div>
        </div>
    </div>
    
@endsection