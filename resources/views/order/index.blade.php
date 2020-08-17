@extends('layouts.app')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/home">Trang chủ</a></li>
        <li class="breadcrumb-item active" aria-current="page">Lịch sử giao dịch</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12 col-lg-12 col-sm-12 col-md-12">
            <table class="table table-dt" id="ordersTable" style="text-align:center;">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Khách</th>
                    <th scope="col">Loại</th>
                    <th scope="col">KL</th>
                    <th scope="col">Thành tiền</th>
                    <th scope="col">Phụ trách</th>
                    <th scope="col">Ngày</th>
                  </tr>
                </thead>
                <tbody>
                    <?php $count = 0; $totalAmount = 0; $totalCharge = 0?>
                    @foreach ($orders as $order)
                      <?php $count = $count + 1 ; $totalAmount = $totalAmount + $order->amount; $totalCharge = $totalCharge +$order->charge ?>
                        <tr>
                          <td scope="row"><a href="/customer/details/{{$order->customer->id}}">{{$order->customer->name}}</a></td>
                          <td scope="row">@if (App\Product::where('id', $order->product_id)->get()->count() > 0)  <a href="/product/details/{{$order->product_id}}">{{App\Product::findOrFail($order->product_id)->name}}</a> @endif</td>
                          <td scope="row">{{$order->amount}} {{$order->unit}}</td>
                          <td scope="row"> <a href="/order/details/{{$order->id}}">{{number_format($order->charge, 0, ',', '.')}} </a></td>  
                          <td scope="row"> @if (App\User::where('id', $order->user_id)->get()->count() > 0) {{App\User::findOrFail($order->user_id)->name}} @endif</td>
                          <td scope="row">{{ date('d-m-Y', strtotime($order->date)) }}</td>   
                        </tr>
                    @endforeach
                  </tbody>
                <tfoot>
                    <tr style="display:@if (Auth::user()->hasSalerPermission())  @else none @endif">
                        <td><button type="button" class="btn btn-secondary" onclick="location.href='/order/create'">Thêm</button></td>
                    </tr>
                </tfoot>
              </table>
        </div>       
    </div>
    <div class="row justify-content-center" style="padding:20px;">
        <label><b>Tổng tiền: <span class="purpletext">{{number_format($totalCharge, 0, ',', '.')}} </span></b></label>
    </div>    
    <form method="POST" action="/order/search">
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
                        <label for="type">Mặt hàng</label> 
                    </div>
                    <div class="col-lg-8 col-sm-8 col-md-8 col-12">
                         <?php $products = App\Product::all() ; ?>
                        <select class="form-control selectpicker" name="product_id">
                            <option value="0">Tất cả</option>
                            @foreach($products as $product)
                            <option value="{{$product->id}}">{{$product->name}} </option>
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
                            <input id="from_date" class="form-control" value="{{request()->input("from_date")}}" type="date" name="from_date" data-date-format="dd-mm-yyyy">
                        </div>               
                  </div> 
                   <div class="row row-item">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                            <label for="to_date">Đến ngày</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-12">
                            <input id="to_date" class="form-control" value="{{request()->input("to_date")}}"  type="date" name="to_date" data-date-format="dd-mm-yyyy">
                        </div>               
                  </div>  
            </div>          
        </div>
        <div class="row row-item justify-content-center">
            <button type="submit" class="btn btn-info">Lọc tìm giao dịch</button>
        </div>
    </form> 
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('select').select2({}); 
        });
    </script>
@endsection