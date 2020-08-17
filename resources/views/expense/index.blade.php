@extends('layouts.app')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/home">Trang chủ</a></li>
        <li class="breadcrumb-item active" aria-current="page">Danh sách chi phí</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12 col-lg-12 col-sm-12 col-md-12">
            <table class="table table-dt" id="expensesTable" style="text-align:center;">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Nội dung</th>
                    <th scope="col">Số tiền</th>
                    <th scope="col">Phụ trách</th>
                    <th scope="col">Ngày</th>
                  </tr>
                </thead>
                <tbody>
                    <?php $count = 0; $totalexpense = 0; ?>
                    @foreach ($expenses as $expense)
                      <?php $count = $count + 1; $totalexpense = $totalexpense + $expense->amount ; ?>
                        <tr>
                        <td scope="row"><a href="/expense/details/{{$expense->id}}">{{$expense->content}}</a></td>
                          <td scope="row">{{number_format($expense->amount,0,',','.')}}</td>
                          <td scope="row"> @if (App\User::where('id', $expense->user_id)->get()->count() > 0) {{App\User::findOrFail($expense->user_id)->name}} @endif</td>
                          <td scope="row">{{ date('d-m-Y', strtotime($expense->date)) }}</td>   
                        </tr>
                    @endforeach
                  </tbody>
                <tfoot>
                    <tr style="display:@if (Auth::user()->hasSalerPermission())  @else none @endif">
                      <td ><button type="button" class="btn btn-secondary" onclick="location.href='/expense/create'">Thêm</button></td>
                    </tr>
                </tfoot>
              </table>
        </div>       
    </div>
    <div class="row justify-content-center" style="padding:20px;">
        <label><b>Tổng tiền: <span class="purpletext">{{number_format($totalexpense, 0, ',', '.')}} </span></b></label>
    </div>  
    <form method="POST" action="/expense/search">
    {{csrf_field()}}
        <div class="row row-item justify-content-center">           
            <div class="form-group col-lg-6 col-md-6 col-12">
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