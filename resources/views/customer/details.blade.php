@extends('layouts.app')
@section('css')
    
@endsection
@section('content')
    <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/khachhang/list">Khách hàng</a></li>
                <li class="breadcrumb-item active" aria-current="page">Chi tiết</li>
            </ol>
    </nav>
    <div class="row" style="padding:15px;">
        <div style="padding-right:10px;">
            <button class="btn btn-info" ><a style="color:white;" href="/charge/create/{{$customer->id}}">Thanh toán</a></button>
        </div>
        <div>
            <button class="btn btn-info"><a style="color:white;" href="/order/create/{{$customer->id}}">Đặt lệnh mới</a></button>
        </div>      
    </div>
    <div class="portlet-background row">
        <div class="col-md-6 portlet" style="padding-right:10px;">
            <div class="portlet-title gray-bg round-corner">
                <label class="">Thông tin cá nhân</label>&nbsp&nbsp<span><a href="/khachhang/edit/{{$customer->id}}"><i class="fa fa-edit"></i></a></span>
            </div>         
            <div class="portlet-body">
                <div class="row row-item">
                    <label class="col-lg-4 col-md-4 col-sm-4 col-4" style="text-align: center">Tên:</label>
                    <label class="col-lg-8 col-md-8 col-sm-8 col-8 greentext" style="text-align: center">{{$customer->customerName}}</label>
                </div>
                <div class="row row-item justify-co">
                    <label class="col-lg-4 col-md-4 col-sm-4 col-4" style="text-align: center">Số đt:</label>
                    <label class="col-lg-8 col-md-8 col-sm-8 col-8 greentext" style="text-align: center"><bold>{{$customer->sdt}}</bold></label>
                </div>
            </div>      
        </div>
        <div class="col-md-6 portlet">
            <div class="portlet-title gray-bg round-corner">
                <label class="">Thông số</label>
            </div> 
            <div class="portlet-body">
                <div class="row row-item">
                      <label class="col-lg-6 col-md-6 col-sm-6 col-6" style="text-align: center">Tài khoản:</label>
                      <label class="col-lg-6 col-md-6 col-sm-6 col-6 greentext" style="text-align: center">{{number_format($customer->getAccount(),0,',','.')}}</label>            
                </div>
                <div class="row row-item">
                      <label class="col-lg-6 col-md-6 col-sm-6 col-6" style="text-align: center">Số lần đặt lệnh:</label>
                      <label class="col-lg-6 col-md-6 col-sm-6 col-6 greentext" style="text-align: center">{{$customer->orders()->count()}}</label>            
                </div>
                <div class="row row-item">
                      <label class="col-lg-6 col-md-6 col-sm-6 col-6" style="text-align: center">Số lệnh thắng</label>
                      <label class="col-lg-6 col-md-6 col-sm-6 col-6 greentext" style="text-align: center">{{$customer->getWinningTimes()}}</label>            
                </div>
            </div>
        </div>
    </div>
    <div class="portlet-background row" style="margin-top:10px;">
        <div class="col-12 col-lg-12 col-sm-12 col-md-12 border-bottom">
            <div class="row row-item">
                <div class=" portlet-title gray-bg round-corner col-lg-12">
                    <label style="margin-left:0; margin-right:auto;">Lịch sử đặt lệnh</label>
                </div>
            </div>
            <div class="row row-item">
                <div class="col-12 col-lg-12 col-sm-12 col-md-12">
                        <table class="table" id="ordersTable" style="text-align:center;">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Ngày</th>
                                    <th scope="col">Mã</th>
                                    <th scope="col">Loại</th>
                                    <th scope="col">Thành tiền</th>
                                    <th scope="col">Kết quả</th>
                                </tr>
                                </thead>
                                <tbody class="greentext">
                                <?php $count = 0; ?>
                                     @foreach ($customer->orders as $order)
                                    <?php $count = $count + 1 ?>
                                        <tr>
                                        <th scope="row">{{$count}}</th>
                                        <th scope="row">{{$order->ngay}}</th>
                                        <td scope="row">{{$order->code}}</td>
                                        <td scope="row">{{$order->getType()}}</td>
                                        <td scope="row">{{number_format($order->sotien,  0, ',', '.')}}</td>                          
                                        <td scope="row">{{$order->getKetQua()}}</td>
                                        </tr>
                                    @endforeach                 
                                </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
    <div class="portlet-background row" style="margin-top:10px;">
            <div class="col-12 col-lg-12 col-sm-12 col-md-12">
                <div class="row row-item">
                    <div class=" portlet-title gray-bg round-corner col-lg-12">
                        <label style="margin-left:0; margin-right:auto;">Biến động tài khoản</label>
                    </div>
                </div>
                <div class="row row-item">
                    <div class="col-12 col-lg-12 col-sm-12 col-md-12">
                            <table class="table" id="chargesTable" style="text-align:center;">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">Ngày</th>
                                        <th scope="col">Thành tiền</th>
                                        <th scope="col">Ghi chú</th>
                                    </tr>
                                    </thead>
                                    <tbody class="greentext">
                                    <?php $count = 0; ?>
                                         @foreach ($customer->charges as $charge)
                                        <?php $count = $count + 1 ?>
                                            <tr>
                                            <th scope="row">{{$count}}</th>
                                            <th scope="row">{{$charge->ngay}}</th>
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
@section('script')
    
@endsection