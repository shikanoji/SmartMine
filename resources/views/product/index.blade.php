@extends('layouts.app')
@section('css')

@endsection
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/home">Trang chủ</a></li>
      <li class="breadcrumb-item active" aria-current="page">Sản phẩm</li>
    </ol>
</nav>

<div class="row justify-content-center">
    <div class="col-12 col-lg-12 col-sm-12 col-md-12">
        <table class="table table-dt" id="products_table" style="width:100%;text-align:center;">
            <thead class="thead-dark">
              <tr>
                <th scope="col" style="width:10%">STT</th>
                <th scope="col">Tên</th>
                <th scope="col">Trạng thái</th>
                <th scope="col" style="width:10%;display:{{Auth::user()->hasAdminPermission()? '' : 'none'}}">Sửa</th>
              </tr>
            </thead>
            <tbody>
              <?php $count = 0; ?>
              @foreach ($products as $product)
                <?php $count = $count + 1 ?>
                  <tr>
                    <th scope="row" style="width:10%">{{$count}}</th>
                    <td><a href="/product/details/{{$product->id}}">{{$product->name}}</a></td>
                    @if ($product->status == "1")
                      <td><span class="greentext">Đang hoạt động</span></td>
                    @else
                      <td><span class="redtext">Đang khoá</span></td>
                      @endif
                    <td style="width:10%;display:{{Auth::user()->hasAdminPermission()? '' : 'none'}}"> 
                      <a href="/product/edit/{{$product->id}}">
                          <span>
                            <i class="fa fa-edit" style="padding-right:10px;"></i>
                          </span>
                      </a> 
                  </tr>
              @endforeach
              
            </tbody>
            <tfoot>
              <tr style="display:@if (Auth::user()->hasAdminPermission())  @else none @endif">
                <td colspan="4"><button type="button" class="btn btn-info" onclick="location.href='/product/create'">Thêm</button></td>
              </tr>
            </tfoot>
          </table>
    </div>  
</div>   

@endsection


