@extends('layouts.app')
@section('css')

@endsection
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/home">Trang chủ</a></li>
      <li class="breadcrumb-item active" aria-current="page">Khách hàng</li>
    </ol>
</nav>

<div class="row justify-content-center">
    <div class="col-12 col-lg-12 col-sm-12 col-md-12">
        <table class="table table-dt" id="customersTable" style="width:100%;text-align:center;">
            <thead class="thead-dark">
              <tr>
                <th scope="col" style="width:10%">TT</th>
                <th scope="col">Tên</th>
                <th scope="col">Sđt</th>
                <th scope="col">Địa chỉ</th>
                <th scope="col">Trạng thái</th>
                <th scope="col" style="width:10%;display:{{Auth::user()->hasSalerPermission()? '' : 'none'}}">Sửa</th>
              </tr>
            </thead>
            <tbody>
              <?php $count = 0; ?>
              @foreach ($customers as $customer)
                <?php $count = $count + 1 ?>
                  <tr>
                    <th scope="row" style="width:5%">{{$count}}</th>
                    <td><a href="/customer/details/{{$customer->id}}">{{$customer->name}}</a></td>
                    <td style="width:10%">{{$customer->phone}}</td>
                    <td >{{$customer->address}}</td>
                    <td style="width:15%"> @if ($customer->status == "1") <span class="greentext">Đang hoạt động</span> @else <span class="redtext">Đã khoá</span> @endif</td>
                    <td style="width:10%; display:{{Auth::user()->hasSalerPermission()? '' : 'none'}}"> 
                      <a href="/customer/edit/{{$customer->id}}">
                          <span>
                            <i class="fa fa-edit" style="padding-right:10px;"></i>
                          </span>
                      </a> 
                      <a href="/order/create/{{$customer->id}}">
                          <span>
                            <i class="fa fa-plus"></i>
                          </span>                                                                                  
                    </td>
                  </tr>
              @endforeach
              
            </tbody>
            <tfoot>
              <tr style="display:{{Auth::user()->hasSalerPermission()? '' : 'none'}}">
                <td colspan="4"><button type="button" class="btn btn-info" onclick="location.href='/customer/create'">Thêm</button></td>
              </tr>
            </tfoot>
          </table>
    </div>  
</div>   

@endsection


