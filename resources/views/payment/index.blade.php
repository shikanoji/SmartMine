@extends('layouts.app')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/home">Trang chủ</a></li>
        <li class="breadcrumb-item active" aria-current="page">Lịch sử thanh toán</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12 col-lg-12 col-sm-12 col-md-12">
            <table class="table table-dt" id="ordersTable" style="text-align:center;">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Khách hàng</th>
                    <th scope="col">Số tiền</th>
                    <th scope="col">Nhân viên phụ trách</th>
                    <th scope="col">Ngày</th>
                  </tr>
                </thead>
                <tbody>
                    <?php $count = 0; $totalPayment = 0; ?>
                    @foreach ($payments as $payment)
                      <?php $count = $count + 1; $totalPayment = $totalPayment + $payment->amount ; ?>
                        <tr>
                          <td scope="row"><a href="/customer/details/{{$payment->customer->id}}">{{$payment->customer->name}}</a></td>
                          <td scope="row"><a href="/payment/details/{{$payment->id}}">{{number_format($payment->amount,0,',','.')}}</a></td>
                          <td scope="row"> @if (App\User::where('id', $payment->user_id)->get()->count() > 0) {{App\User::findOrFail($payment->user_id)->name}} @endif</td>
                          <td scope="row">{{ date('d-m-Y', strtotime($payment->date)) }}</td>   
                        </tr>
                    @endforeach
                  </tbody>
                <tfoot>
                    <tr style="display:@if (Auth::user()->hasSalerPermission()) block @else none @endif">
                      <td ><button type="button" class="btn btn-secondary" onclick="location.href='/payment/create'">Thêm</button></td>
                    </tr>
                </tfoot>
              </table>
        </div>       
    </div>
    <div class="row justify-content-center" style="padding:20px;">
        <label><b>Tổng tiền: <span class="purpletext">{{number_format($totalPayment, 0, ',', '.')}} </span></b></label>
    </div>  
    <form method="POST" action="/payment/search">
    {{csrf_field()}}
        <div class="row row-item justify-content-center">           
            <div class="form-group col-lg-6 col-md-6 col-12">
                <div class="row row-item">
                    <div class="col-lg-4 col-sm-4 col-md-4 col-12">
                        <label for="customer_id">Khách hàng</label> 
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-12">
                        <select class="selectpicker form-control" name="customer_id">
                            <option value="0">Tất cả</option>
                            @foreach($customers as $customer)
                            <option value="{{$customer->id}}" {{($customer->id == request()->input("customer_id")) ? "selected" : ""}}>{{$customer->name}} - {{$customer->phone}} </option>
                            @endforeach
                        </select>
                    </div>            
                </div>
                <div class="row row-item">
                        <div class="col-lg-4 col-sm-4 col-md-4 col-12">
                        <label for="order-type">Người phụ trách</label> 
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-12">
                        <select class="selectpicker form-control" name="user_id">
                          <option value="0">Tất cả</option>
                            @foreach($users as $user)
                            <option value="{{$user->id}}" {{($user->id == request()->input("user_id")) ? "selected" : ""}}>{{$user->name}} </option>
                            @endforeach
                        </select>
                    </div> 
                  </div>    
            </div>  
            <div class="form-group col-lg-6 col-md-6 col-12">
                  <div class="row row-item">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                            <label for="from_date">Từ ngày</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-12">
                            <input id="from_date" class="form-control" value="{{request()->input("from_date")}}" type="date" name="from_date" data-date-format="mm/dd/yyyy">
                        </div>               
                  </div> 
                  <div class="row row-item">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                            <label for="to_date">Đến ngày</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-12">
                            <input id="to_date" class="form-control" value="{{request()->input("to_date")}}" type="date" name="to_date" data-date-format="mm/dd/yyyy">
                        </div>               
                  </div>
            </div>          
        </div>
        <div class="row row-item justify-content-center">
            <button type="submit" class="btn btn-info">Lọc tìm thanh toán</button>
        </div>
    </form> 
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('select').select2({
            }
            );            
        });
    </script>
@endsection