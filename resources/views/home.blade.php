@extends('layouts.app')
@section('css')     
@endsection        
@section('content')
<div class="container">
    <div class="row border-bottom" style="">
        <div onclick="location.href='/order/index'" class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat greentext">
                <div class="display">
                    <div class="number">
                        <h3 class="">
                            <span class="count" >150</span>
                        </h3>
                        <i class="fa fa-bullhorn"></i>&nbsp
                        <small>Lệnh đang mở</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat purpletext ">
                <div class="display">
                    <div class="number">
                        <h3 class="">
                            <span class="count" >10</span> <span>tr</span> 
                        </h3>
                        <i class="fa fa-bank"></i>&nbsp 
                        <small>Doanh thu ngày</small>
                    </div>
                </div>
            </div>
        </div>
        <div onclick="location.href='/khachhang/list'" class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat bluetext ">
                <div class="display">
                    <div class="number">
                        <h3 class="">
                            <span class="count">120</span>
                        </h3>
                        <i class="fa fa-group"></i>&nbsp 
                        <small>Khách hàng</small>
                    </div>
                </div>
            </div>
        </div>
        <div onclick="location.href='/khachhang/accounts'" class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat redtext">
                <div class="display">
                    <div class="number">
                        <h3 class="">
                            <span class="count">20</span> <span>tr</span> 
                        </h3>
                        <i class="fa fa-book"></i>&nbsp
                        <small>Dư nợ khách hàng</small>
                    </div>
                </div>
            </div>
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
                duration: 1000,
                easing: 'swing',
                step: function (now) {
                    $(this).text(Math.ceil(now));
                }
            });
        });
        
    </script>
@endsection