@extends('layouts.app')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/home">Quản trị</a></li>
        <li class="breadcrumb-item active" aria-current="page">Lịch sử đặt lệnh</li>
        </ol>
    </nav>
    <div class="row justify-content-center" style ="margin-left: 5px; margin-right:5px;">
        <table class="table" id="ordersTable" style="width:100%;text-align:center;">
        <thead class="thead-dark">
          <tr>
            <th scope="col"></th>
            <th scope="col">Khách hàng</th>
            <th scope="col">Loại</th>
            <th scope="col">Mã</th>
            <th scope="col">Số tiền</th>
            <th scopre="col">Kết quả</th>
          </tr>
        </thead>
        <tbody>
            <?php $count = 0; ?>
            @foreach ($orders as $order)
              <?php $count = $count + 1 ?>
                <tr>
                  <th scope="row">{{$count}}</th>
                  <td scope="row"><a href="/khachhang/details/{{$order->customer->id}}">{{$order->customer->customerName}}</a></td>
                  <td scope="row">{{$order->getType()}}</td>
                  <td scope="row">{{$order->code}}</td>
                  <td scope="row" >{{number_format($order->sotien, 0, ',', '.')}}</td>     
                  <td scope="row">{{$order->getKetQua()}}</td>
                </tr>
            @endforeach
          </tbody>
        <tfoot>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"><button type="button" class="btn btn-info" onclick="location.href='/order/create'">Thêm</button></th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tfoot>
      </table>
    </div>
@endsection
@section('script')
    <script>
      $(document).ready(function() {
          $('#ordersTable').DataTable( {
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
            "columnDefs": [
              { "width": "10%", "targets": 0 }
            ],
            "autoWidth": true,
          } );
      } );
  </script>
@endsection