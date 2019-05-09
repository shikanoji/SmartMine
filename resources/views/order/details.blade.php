@extends('layouts.app')
@section('content')
    <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="/order/index">Lịch sử đặt lệnh</a></li>
                <li class="breadcrumb-item active" aria-current="page">Chi tiết lệnh</li>
            </ol>
    </nav>
    <div class="row" style="text-align:center;">
        <div class="col-12 col-md-6 col-lg-6">
            <div class="row row-item">
                <div class="col-6 col-md-6 col-lg-6">
                    <label>Ngày đặt</label>
                </div>
                <div class="col-6 col-md-6 col-lg-6">
                    <label class="greentext">{{ date('d/m/y', strtotime($order->ngay)) }}</label>
                </div>
            </div>
            <div class="row row-item">
                <div class="col-6 col-md-6 col-lg-6">
                    <label>Người dùng</label>
                </div>
                <div class="col-6 col-md-6 col-lg-6">
                    <label class="greentext"><a href="/khachhang/details/{{$order->customer->id}}">{{$order->customer->customerName}}</a></label>
                </div>
            </div>
            <div class="row row-item">
                <div class="col-6 col-md-6 col-lg-6">
                    <label>Loại</label>
                </div>
                <div class="col-6 col-md-6 col-lg-6">
                    <label class="greentext">{{ $order->getType()}}</label>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-6">
            <div class="row row-item">
                <div class="col-6 col-md-6 col-lg-6">
                    <label>Mã</label>
                </div>
                <div class="col-6 col-md-6 col-lg-6">
                    <label class="greentext">{{ $order->code }}</label>
                </div>
            </div>
            <div class="row row-item">
                <div class="col-6 col-md-6 col-lg-6">
                    <label>Số tiền</label>
                </div>
                <div class="col-6 col-md-6 col-lg-6">
                    <label class="greentext">{{$order->sotien}}</label>
                </div>
            </div>
            <div class="row row-item">
                <div class="col-6 col-md-6 col-lg-6">
                    <label>Kết quả</label>
                </div>
                <div class="col-6 col-md-6 col-lg-6">
                    <label class="greentext">{{ $order->getKetQua()}}</label>
                </div>
            </div>
        </div>
    </div>
    <div class="portlet-background row" style="margin-top:10px;">
            <div class="col-12 col-lg-12 col-sm-12 col-md-12">
                <div class="row row-item">
                    <div class=" portlet-title gray-bg round-corner col-lg-12">
                        <label style="margin-left:0; margin-right:auto;margin-top:5px;">Các thanh toán liên quan</label>
                    </div>
                </div>
                <div class="row row-item">
                    <div class="col-12 col-lg-12 col-sm-12 col-md-12">
                            <table class="table table-dt" id="chargesTable" style="text-align:center;">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Ngày giờ</th>
                                        <th scope="col">Thành tiền</th>
                                        <th scope="col">Ghi chú</th>
                                    </tr>
                                    </thead>
                                    <tbody class="greentext">
                                    <?php $count = 0; ?>
                                         @foreach ($order->charges as $charge)
                                        <?php $count = $count + 1 ?>
                                            <tr>
                                            <th scope="row">{{ date('d/m/y H:i:s', strtotime($charge->created_at)) }}</th>
                                            <td scope="row">{{number_format($charge->chargeMoney,  0, ',', '.')}}</td> 
                                            <td scope="row">{{$charge->note}}</td>                         
                                            </tr>
                                        @endforeach                 
                                    </tbody>
                            </table>
                    </div>                
                </div>
            </div>
        </div>
@endsection