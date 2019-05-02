@extends('layouts.app')
@section('css')

@endsection
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/home">Quản trị</a></li>
      <li class="breadcrumb-item active" aria-current="page">Quản lý nợ</li>
    </ol>
</nav>

<div class="row justify-content-center">
  <div class="col-12 col-lg-12 col-sm-12 col-md-12">
    <table class="table" id="accountsTable" style="text-align:center;">
      <thead class="thead-dark">
        <tr>
          <th scope="col"></th>
          <th scope="col">Tên</th>
          <th scope="col">Sđt</th>
          <th scope="col">Tài khoản</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <?php $count = 0; ?>
        @foreach ($customers as $customer)
          <?php $count = $count + 1 ?>
            <tr>
              <th scope="row">{{$count}}</th>
              <td><a href="/khachhang/details/{{$customer->id}}">{{$customer->customerName}}</a></td>
              <td>{{$customer->sdt}}</td>
              <td>{{number_format($customer->getTaiKhoan(),0,',','.')}} </td>
              <td> 
                <a href="/khachhang/edit/{{$customer->id}}">
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
    </table>
  </div>   
</div>   
@endsection

@section('script')
  <script>
      $(document).ready(function() {
          $('#accountsTable').DataTable( {
            "language": {        
                "sProcessing":   "Đang xử lý...",
                "sLengthMenu":   "Xem _MENU_ mục",
                "sZeroRecords":  "Không có kết quả nào",
                "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
                "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
                "sInfoFiltered": "(được lọc từ _MAX_ mục)",
                "sInfoPostFix":  "",
                "sSearch":       "Tìm:",
                "sUrl":          "",
                "oPaginate": {
                  "sFirst":    "Đầu",
                  "sPrevious": "Trước",
                  "sNext":     "Tiếp",
                  "sLast":     "Cuối"
                }
            },
            "paging": true,           
            "autoWidth": true,
          } );
      } );
  </script>

 @endsection     

