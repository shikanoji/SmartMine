@extends('layouts.app')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/home">Quản trị</a></li>
        <li class="breadcrumb-item active" aria-current="page">Lịch sử đặt lệnh</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12 col-lg-12 col-sm-12 col-md-12">
            <table class="table" id="ordersTable" style="text-align:center;">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Khách hàng</th>
                    <th scope="col">Loại</th>
                    <th scope="col">Mã</th>
                    <th scope="col">Số tiền</th>
                    <th scope="col">Ngày</th>
                    <th scope="col">Kết quả</th>
                  </tr>
                </thead>
                <tbody>
                    <?php $count = 0; ?>
                    @foreach ($orders as $order)
                      <?php $count = $count + 1 ?>
                        <tr>
                          <td scope="row"><a href="/khachhang/details/{{$order->customer->id}}">{{$order->customer->customerName}}</a></td>
                          <td scope="row">{{$order->getType()}}</td>
                          <td scope="row">{{$order->code}}</td>
                          <td scope="row">{{number_format($order->sotien, 0, ',', '.')}}</td>  
                          <td scope="row">{{$order->ngay}}</td>   
                          <td scope="row">{{$order->getKetQua()}}</td>
                        </tr>
                    @endforeach
                  </tbody>
                <tfoot>
                    <th scope="col"><button type="button" class="btn btn-info" onclick="location.href='/order/create'">Thêm</button></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tfoot>
              </table>
        </div>       
    </div>
@endsection
@section('script')
@endsection