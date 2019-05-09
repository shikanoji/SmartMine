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
                            <span class="count" >{{$orders->where('status','waiting')->count()}}</span>
                        </h3>
                        <i class="fa fa-bullhorn"></i>&nbsp
                        <small>Lệnh đang mở</small>
                    </div>
                </div>
            </div>
        </div>
        <div onclick="location.href='/result/index'" class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat purpletext ">
                <div class="display">
                    <div class="number">
                        <h3 class="">
                            <span class="count" >100</span> <span>%</span> 
                        </h3>
                        <i class="fa fa-book"></i>&nbsp 
                        <small>Cập nhật kết quả</small>
                    </div>
                </div>
            </div>
        </div>
        <div onclick="location.href='/khachhang/list'" class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat bluetext ">
                <div class="display">
                    <div class="number">
                        <h3 class="">
                            <span class="count">{{$customers->count()}}</span>
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
                            <span class="count">{{-$totalAccount/1000}}</span> <span>K</span> 
                        </h3>
                        <i class="fa fa-bank"></i>&nbsp
                        <small>Dư nợ khách hàng</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="rol-12 col-md-12 col-lg-6">

        </div>
        <div class="rol-12 col-md-12 col-lg-6">
            
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