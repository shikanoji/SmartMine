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
                    <div class="dashboard-stat purpletext">
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
                    <div class="dashboard-stat bluetext">
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
                <div onclick="location.href='/expense/index'" class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat redtext ">
                        <div class="display">
                            <div class="number">
                                <h3 class="">
                                    <span class="count">{{$data['dailyExpense']}}</span>
                                </h3>
                                <i class="fa fa-balance-scale"></i>&nbsp 
                                <small><b>Chi phí</b></small>
                            </div>
                        </div>
                    </div>
                </div>
                <div onclick="location.href='/payment/index'" class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat greentext">
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
    <div class="row" style="padding-bottom: 10px;">
        <div class="col-12 col-md-6 col-lg-6" style="margin-top:20px;">
            <div class="row" style="padding-bottom:10px;"> 
                <div onclick="location.href='/order/index'" class="col-6" style="padding-left:0px;">
                    <span class="badge badge-warning" >Giao dịch mới nhất</span>
                </div>
            </div>
            <div class="row" style="padding-bottom:10px;">
                <?php $newestOrders = App\Order::orderBy('created_at','DESC')->take(10)->get() ?>
                <ul style="width:95%" class="list-group">
                    @foreach ($newestOrders as $order)
                    <li class="list-group-item bluetext">{{$order->amount}} {{$order->unit}} {{$order->product->name}} - {{$order->customer->name}} - {{number_format($order->charge, 0, ',', '.')}} VNĐ  </li>
                    @endforeach
                    <li class="list-group-item"><a href="/order/index">...</a></li>
                </ul>
            </div> 
            <div class="row">
                <button  type="button" class="btn btn-warning" style="padding:2px;display:{{Auth::user()->hasSalerPermission()? '' : 'none'}}"><a style="color:black" href="/order/create">Thêm mới</a></button>
            </div> 
        </div>
        <div class=" col-12 col-md-6 col-lg-6" style="margin-top:20px;">
            <div class="row" style="padding-bottom:10px;"> 
                <div onclick="location.href='/payment/index'" class="col-6" style="padding-left:0px;">
                    <span class="badge badge-success" >Thanh toán mới nhất</span>
                </div>
            </div>
            <div class="row" style="padding-bottom:10px;">
                <?php $newestPayments = App\Payment::orderBy('created_at', 'DESC')->take(10)->get() ?>
                <ul style="width:95%" class="list-group">
                    @foreach ($newestPayments as $payment)
                    <li class="list-group-item greentext">{{number_format($payment->amount, 0, ',', '.')}} VNĐ - {{$payment->customer->name}} - {{$payment->note}}</li>
                    @endforeach
                    <li class="list-group-item"><a class="greentext" href="/order/index">...</a> </li>
                </ul>
            </div>  
            <div class="row">
                <button  type="button" class="btn btn-success" style="padding:2px;display:{{Auth::user()->hasSalerPermission()? 'block' : 'none'}}"><a style="color:white" href="/order/payment">Thêm mới</a></button>
            </div>
        </div>
    </div>
    <div class="row border-bottom" style="padding-bottom: 10px;">
        <div class="col-12 col-md-6 col-lg-6 mx-auto" style="margin-top:20px;">
            <div onclick="location.href='/expense/index'" class="row" style="padding-bottom:10px;"> 
                <div class="col-6" style="padding-left:0px;">
                    <span class="badge badge-danger" >Chi phí mới nhất</span>
                </div>
            </div>
            <div class="row" style="padding-bottom:10px;">
                <?php $newestExpenses = App\Expense::orderBy('created_at', 'DESC')->take(10)->get() ?>
                <ul style="width:95%" class="list-group">
                    @foreach ($newestExpenses as $expense)
                    <li class="list-group-item redtext">{{$expense->user->name}} - {{$expense->content}} - {{number_format($expense->amount, 0, ',', '.')}} VNĐ  </li>
                    @endforeach
                    <li class="list-group-item"><a class="redtext" href="/expense/index">...</a></li>
                </ul>
            </div>  
            <div class="row">
                <button  type="button" class="btn btn-danger" style="padding:2px;display:{{Auth::user()->hasSalerPermission()? '' : 'none'}}"><a style="color:white" href="/expense/create">Thêm mới</a></button>
            </div>
        </div>
    </div>
    <div class="row" style="padding-top:5px;">
        <span class="badge badge-pill badge-light"><b>Biểu đồ 7 ngày</b></span>
    </div>
    <div class="row border-bottom" style="padding-bottom: 10px;">
        <div class="col-12 col-md-4 col-lg-4" style="margin-top:20px;">
            <canvas id="value_chart" width="400" height="400"></canvas>
        </div>
        <div class="col-12 col-md-4 col-lg-4" style="margin-top:20px;">
            <canvas id="revenue_chart" width="400" height="400"></canvas>
        </div>
        <div class="col-12 col-md-4 col-lg-4" style="margin-top:20px;">
            <canvas id="expense_chart" width="400" height="400"></canvas>
        </div>
    </div>
</div>
@endsection

@section('script')
     <script>
        $('.count').each(function () {
            $(this).prop('Counter',0).animate({
                Counter: $(this).text()
            }, {
                duration: 2000,
                easing: 'swing',
                step: function (now) {
                    $(this).text(Math.ceil(now).toLocaleString('en'));
                }
            });
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
                            label: 'Doanh thu ngày (triệu)',
                            data: revenues,
                            fill: false,
                            borderColor: "#2ab4c0",
                            pointBackgroundColor: "#ffe24e",
                            pointBorderColor: "#ffe24e",
                            pointHoverBackgroundColor: "#ffe24e",
                            pointHoverBorderColor: "#ffe24e",
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
                            label: 'Tổng giá trị đơn ngày (triệu)',
                            data: values,
                            fill: false,
                            borderColor: "#5C9BD1",
                            pointBackgroundColor: "#ffe24e",
                            pointBorderColor: "#ffe24e",
                            pointHoverBackgroundColor: "#ffe24e",
                            pointHoverBorderColor: "#ffe24e",
                        }]
                    },
                    options: options,
                });

                //Config expense chart
                var expense_ctx = document.getElementById('expense_chart');
                var expenses = @json($data['expenseByDate']);
                var myChart = new Chart(expense_ctx, {
                    type: 'line',
                    data: {
                        labels: dateLabels,
                        datasets: [{
                            label: 'Chi phí ngày (triệu)',
                            data: expenses,
                            fill: false,
                            borderColor: "#f36a5a",
                            pointBackgroundColor: "#ffe24e",
                            pointBorderColor: "#ffe24e",
                            pointHoverBackgroundColor: "#ffe24e",
                            pointHoverBorderColor: "#ffe24e",
                        }]
                    },
                    options: options,
                });
    </script>
@endsection