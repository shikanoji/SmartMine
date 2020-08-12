@extends('layouts.app')
@section('css')
    
@endsection
@section('content')
    <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="/customer/list">Khách hàng</a></li>
                <li class="breadcrumb-item active" aria-current="page">Chi tiết</li>
            </ol>
    </nav>
    <div class="row" style="padding:15px;">
        <div style="padding-right:10px;">
            <button class="btn btn-info" ><a style="color:white;" href="/payment/create/{{$customer->id}}">Thanh toán</a></button>
        </div>
        <div style="padding-right:10px;">
            <button class="btn btn-info"><a style="color:white;" href="/order/create/{{$customer->id}}">Đặt lệnh mới</a></button>
        </div>
        <div>
            <form method="post" action="/customer/lock/{{$customer->id}}">
                {{csrf_field()}}
                <button type="submit" class="btn btn-warning" >{{($customer->status == "1")? "Khoá" : "Mở khoá" }}</button>
            </form>
        </div>      
    </div>
    <div class="portlet-background row">
        <div class="col-md-6 portlet" style="padding-right:10px;">
            <div class="portlet-title gray-bg round-corner">
                <label style="margin-left:0; margin-right:auto;margin-top:5px;">Thông tin cá nhân</label>&nbsp&nbsp<span><a href="/customer/edit/{{$customer->id}}"><i class="fa fa-edit"></i></a></span>
            </div>         
            <div class="portlet-body">
                <div class="row row-item">
                    <label class="col-lg-4 col-md-4 col-sm-4 col-4" style="text-align: center">Tên:</label>
                    <label class="col-lg-8 col-md-8 col-sm-8 col-8 greentext" style="text-align: center">{{$customer->name}}</label>
                </div>
                <div class="row row-item justify-co">
                    <label class="col-lg-4 col-md-4 col-sm-4 col-4" style="text-align: center">Số đt:</label>
                    <label class="col-lg-8 col-md-8 col-sm-8 col-8 greentext" style="text-align: center"><bold>{{$customer->phone}}</bold></label>
                </div>
                <div class="row row-item justify-co">
                    <label class="col-lg-4 col-md-4 col-sm-4 col-4" style="text-align: center">Địa chỉ:</label>
                    <label class="col-lg-8 col-md-8 col-sm-8 col-8 greentext" style="text-align: center"><bold>{{$customer->address}}</bold></label>
                </div>
                <div class="row row-item justify-co">
                    <label class="col-lg-4 col-md-4 col-sm-4 col-4" style="text-align: center">Tình trạng:</label>
                    @if ($customer->status == "1") 
                    <label class="col-lg-8 col-md-8 col-sm-8 col-8 greentext" style="text-align: center"><bold>Đang hoạt động</bold></label>
                    @else
                    <label class="col-lg-8 col-md-8 col-sm-8 col-8 redtext" style="text-align: center"><bold>Đang khoá</bold></label>
                    @endif
                </div>
            </div>      
        </div>
        <div class="col-md-6 portlet">
            <div class="portlet-title gray-bg round-corner">
                <label style="margin-left:0; margin-right:auto;margin-top:5px;">Báo cáo tài chính</label>
            </div> 
            <div class="portlet-body">
                <div class="row row-item">
                      <label class="col-lg-6 col-md-6 col-sm-6 col-6" style="text-align: center">Dư nợ:</label>
                      <label class="col-lg-6 col-md-6 col-sm-6 col-6 greentext" style="text-align: center">{{number_format($customer->getBalance(),0,',','.')}}</label>            
                </div>
                <div class="row row-item">
                      <label class="col-lg-6 col-md-6 col-sm-6 col-6" style="text-align: center">Số giao dịch:</label>
                      <label class="col-lg-6 col-md-6 col-sm-6 col-6 greentext" style="text-align: center">{{$customer->orders()->count()}}</label>            
                </div>
                <div class="row row-item">
                      <label class="col-lg-6 col-md-6 col-sm-6 col-6" style="text-align: center">Tổng tiền mua:</label>
                      <label class="col-lg-6 col-md-6 col-sm-6 col-6 greentext" style="text-align: center">{{number_format($customer->getTotalCharge(),0,',','.')}}</label>            
                </div>
                <div class="row row-item">
                      <label class="col-lg-6 col-md-6 col-sm-6 col-6" style="text-align: center">Tổng tiền đã thanh toán:</label>
                      <label class="col-lg-6 col-md-6 col-sm-6 col-6 greentext" style="text-align: center">{{number_format($customer->getTotalPayment(),0,',','.')}}</label>            
                </div>
            </div>
        </div>
    </div>
    <div class="portlet-background row" style="margin-top:10px;">
        <div class="col-12 col-lg-12 col-sm-12 col-md-12 border-bottom">
            <div class="row row-item">
                <div class=" portlet-title gray-bg round-corner col-lg-12">
                    <label style="margin-left:0; margin-right:auto;margin-top:5px;">Lịch sử giao dịch</label>
                </div>
            </div>
            <div class="row row-item">
                <div class="col-12 col-lg-12 col-sm-12 col-md-12">
                        <table class="table table-dt" id="ordersTable" style="text-align:center;">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Ngày</th>
                                    <th scope="col">Loại</th>
                                    <th scope="col">Khối lượng</th>
                                    <th scope="col">Đơn vị</th>
                                    <th scope="col">Thành tiền</th>
                                </tr>
                                </thead>
                                <tbody class="greentext">
                                <?php $count = 0; ?>
                                     @foreach ($customer->orders as $order)
                                    <?php $count = $count + 1 ?>
                                        <tr>
                                        <th scope="row" style="width:15%">{{date('d-m-Y', strtotime($order->created_at))}}</th>
                                        <td scope="row"><a href="/product/details/{{$order->product_id}}">@if (App\Product::where('id', $order->product_id)->get()->count() > 0) {{App\Product::findOrFail($order->product_id)->name}} @endif</a></td>
                                        <td scope="row">{{$order->amount}}</td>
                                        <td scope="row">{{$order->unit}}</td>
                                        <td scope="row">{{number_format($order->charge,  0, ',', '.')}}</td>                          
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
                        <label style="margin-left:0; margin-right:auto;margin-top:5px;">Lịch sử thanh toán</label>
                    </div>
                </div>
                <div class="row row-item">
                    <div class="col-12 col-lg-12 col-sm-12 col-md-12">
                            <table class="table table-dt" id="chargesTable" style="text-align:center;">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Ngày</th>
                                        <th scope="col">Thành tiền</th>
                                        <th scope="col">Phụ trách</th>
                                        <th scope="col">Ghi chú</th>
                                    </tr>
                                    </thead>
                                    <tbody class="greentext">
                                    <?php $count = 0; ?>
                                         @foreach ($customer->payments as $payment)
                                        <?php $count = $count + 1 ?>
                                            <tr>
                                            <th scope="row" style="width:15%">{{ date('d-m-Y', strtotime($payment->created_at)) }}</th>
                                            <td scope="row">{{number_format($payment->amount,  0, ',', '.')}}</td> 
                                            <td scope="row">@if (App\User::where('id', $payment->user_id)->get()->count() > 0) {{App\User::findOrFail($payment->user_id)->name}} @endif</td> 
                                            <td scope="row">{{$payment->note}}</td>                         
                                            </tr>
                                        @endforeach                 
                                    </tbody>
                            </table>
                    </div>                
                </div>
            </div>
        </div>
@endsection
