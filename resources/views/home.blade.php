@extends('layouts.app')
@section('css')     
@endsection        
@section('content')
<div class="container">
    <div class="row border-bottom">
        <div class="col-12"> 
            <div class="row" style="padding-bottom:5px;">
                <span class="badge badge-pill badge-light"><b>Tình hình trong ngày</b></span>
            </div>
            <div class="row" style="background-color: aliceblue; border-radius:10px;">
                <div onclick="location.href='/order/index'" class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat greentext">
                        <div class="display">
                            <div class="number">
                                <h3 class="">
                                    <span class="count" >{{$data['orderCount']}}</span>
                                </h3>
                                <i class="fa fa-exchange"></i>&nbsp
                                <small><b>Giao dịch</b></small>
                            </div>
                        </div>
                    </div>
                </div>
                <div onclick="location.href='/order/index'" class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat purpletext ">
                        <div class="display">
                            <div class="number">
                                <h3 class="">
                                    <span class="count" >{{$data['orderTotalValue']}}</span>  
                                </h3>
                                <i class="fa fa-money"></i>&nbsp 
                                <small><b>Giá trị</b></small>
                            </div>
                        </div>
                    </div>
                </div>
                <div onclick="location.href='/customer/index'" class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat bluetext ">
                        <div class="display">
                            <div class="number">
                                <h3 class="">
                                    <span class="count">{{$data['customerCount']}}</span>
                                </h3>
                                <i class="fa fa-group"></i>&nbsp 
                                <small><b>Khách hàng</b></small>
                            </div>
                        </div>
                    </div>
                </div>
                <div onclick="location.href='/payment/index'" class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat redtext">
                        <div class="display">
                            <div class="number">
                                <h3 class="">
                                    <span class="count">{{$data['dailyRevenue']}}</span> 
                                </h3>
                                <i class="fa fa-bank"></i>&nbsp
                                <small><b>Doanh thu</b></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row border-bottom" style="padding-bottom: 10px;">
        <div class="col-12 col-md-12 col-lg-6" style="margin-top:20px;">
            <div class="row" style="padding-bottom:10px;"> 
                <span class="badge badge-success">Giao dịch mới nhất</span>
            </div>
            <div class="row" style="padding-bottom:10px;">
                <?php $newestOrders = App\Order::orderBy('date', 'DESC')->take(10)->get() ?>
                <ul style="width:95%" class="list-group">
                    @foreach ($newestOrders as $order)
                    <li class="list-group-item">{{$order->amount}} {{$order->unit}} {{$order->product->name}} - {{$order->customer->name}} - {{number_format($order->charge, 0, ',', '.')}} VNĐ  </li>
                    @endforeach
                    <li class="list-group-item">...</li>
                </ul>
            </div>  
            <div class="row"> 
                <button style="margin-right:20px;" type="button" class="btn btn-secondary"><a style="color:white" href="/order/index">Xem toàn bộ</a></button>
                <button  type="button" class="btn btn-info" style="display:{{Auth::user()->hasSalerPermission()? 'block' : 'none'}}"><a style="color:white" href="/order/create">Thêm mới</a></button>
            </div>
        </div>
        <div class=" col-12 col-md-12 col-lg-6" style="margin-top:20px;">
            <div class="row" style="padding-bottom:10px;"> 
                <span class="badge badge-success">Thanh toán mới nhất</span>
            </div>
            <div class="row" style="padding-bottom:10px;">
                <?php $newestPayments = App\Payment::orderBy('date', 'DESC')->take(10)->get() ?>
                <ul style="width:95%" class="list-group">
                    @foreach ($newestPayments as $payment)
                    <li class="list-group-item">{{number_format($payment->amount, 0, ',', '.')}} VNĐ - {{$payment->customer->name}} - {{$payment->note}}</li>
                    @endforeach
                    <li class="list-group-item">...</li>
                </ul>
            </div>  
            <div class="row"> 
                <button style="margin-right:20px;" type="button" class="btn btn-secondary"><a style="color:white" href="/payment/index">Xem toàn bộ</a></button>
                <button  type="button" class="btn btn-info" style="display:{{Auth::user()->hasSalerPermission()? 'block' : 'none'}}"><a style="color:white" href="/order/payment">Thêm mới</a></button>
            </div>
        </div>
    </div>
    <div class="row border-bottom" style="padding-bottom: 10px;">
        <div class="col-12 col-md-12 col-lg-6" style="margin-top:20px;">
            <canvas id="value_chart" width="400" height="400"></canvas>
        </div>
        <div class="col-12 col-md-12 col-lg-6" style="margin-top:20px;">
            <canvas id="revenue_chart" width="400" height="400"></canvas>
        </div>
    </div>
</div>
@endsection

@section('script')
     <script>
        $('.count').each(function () {
                var $this = $(this);
                jQuery({Counter: 0}).animate({Counter: $this.text()}, {
                    duration: 1500,
                    easing: 'swing',
                    step: function() {
                        var num = Math.ceil(this.Counter).toString();
                        if(Number(num) > 999){
                            while (/(\d+)(\d{3})/.test(num)) {
                                num = num.replace(/(\d+)(\d{3})/, '$1' + '.' + '$2');
                            }
                        }
                        $this.text(num);
                    }
                });
                //Config revenue chart
                var options = {
                    scales: {
                        yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            callback: function(value, index, values) {
                            if(parseInt(value) >= 1000){
                                return  value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            } else {
                                return  value;
                            }
                            }
                        }
                        }]
                    }
                }

                var revenue_ctx = document.getElementById('revenue_chart');
                var revenues = @json($data['revenuesByDate']);
                var d = new Date();
                var dateLabels = [];
                for (i = 6; i > 0; i--) {
                    var last = new Date(d.getTime() - (i * 24 * 60 * 60 * 1000));
                    var day = last.getDate();
                    dateLabels.push(day);
                }
                dateLabels.push(d.getDate());
                var myChart = new Chart(revenue_ctx, {
                    type: 'line',
                    data: {
                        labels: dateLabels,
                        datasets: [{
                            label: 'Doanh thu 7 ngày gần nhất',
                            data: revenues,
                            fill: false,
                            borderColor: "#ff735a",
                            pointBackgroundColor: "#55bae7",
                            pointBorderColor: "#55bae7",
                            pointHoverBackgroundColor: "#55bae7",
                            pointHoverBorderColor: "#55bae7",
                        }]
                    },
                    options: options,
                });

                //Config order value chart
                var value_ctx = document.getElementById('value_chart');
                var values = @json($data['valuesByDate']);
                var myChart = new Chart(value_ctx, {
                    type: 'line',
                    data: {
                        labels: dateLabels,
                        datasets: [{
                            label: 'Tổng giá trị đơn 7 ngày gần nhất',
                            data: values,
                            fill: false,
                            borderColor: "#c4e681",
                            pointBackgroundColor: "#55bae7",
                            pointBorderColor: "#55bae7",
                            pointHoverBackgroundColor: "#55bae7",
                            pointHoverBorderColor: "#55bae7",
                        }]
                    },
                    options: options,
                });
            });
    </script>
@endsection