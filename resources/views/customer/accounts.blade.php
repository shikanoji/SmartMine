@extends('layouts.app')
@section('css')

@endsection
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/home">Trang chủ</a></li>
      <li class="breadcrumb-item active" aria-current="page">Dư nợ khách hàng</li>
    </ol>
</nav>

<div class="row justify-content-center">
  <div class="col-12 col-lg-12 col-sm-12 col-md-12">
    <table class="table table-dt" id="accountsTable" style="text-align:center;">
      <thead class="thead-dark">
        <tr>
          <th scope="col"></th>
          <th scope="col">Tên</th>
          <th scope="col">Sđt</th>
          <th scope="col">Dư nợ</th>
          <th scope="col">Thanh toán</th>
        </tr>
      </thead>
      <tbody>
        <?php $count = 0; ?>
        @foreach ($customers as $customer)
          <?php $count = $count + 1 ?>
            <tr>
              <th scope="row">{{$count}}</th>
              <td><a href="/customer/details/{{$customer->id}}">{{$customer->name}}</a></td>
              <td>{{$customer->phone}}</td>
              <td>{{number_format($customer->getBalance(),0,',','.')}} </td>
              <td> 
                <a href="/payment/create/{{$customer->id}}">
                    <span>
                      <i class="fa fa-credit-card" style="padding-right:10px;"></i>
                    </span>
                </a>                                                                                 
              </td>
            </tr>
        @endforeach
        
      </tbody>
    </table>
  </div>   
</div>   
@endsection


