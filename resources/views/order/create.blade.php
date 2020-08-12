@extends('layouts.app')
@section('css')
@endsection
@section('content')
    <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="/order/index">Lịch sử giao dịch</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tạo giao dịch mới</li>
            </ol>
    </nav>
    <form method="POST" action="/order/create">
    {{csrf_field()}}
        <div class="row row-item justify-content-center">           
            <div class="form-group col-lg-6 col-md-6 col-12">
                <div class="row row-item">
                    <div class="col-lg-4 col-sm-4 col-md-4 col-12">
                        <label for="order-type">Khách hàng</label> 
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-12">
                        <?php $customerNo = isset($customerId)? $customerId : 1 ; ?>
                        <select class="selectpicker form-control" name="customer_id" required>
                            @foreach($customers as $customer)
                            <option value="{{$customer->id}}" {{($customer->id == $customerNo) ? "selected" : ""}}>{{$customer->name}} - {{$customer->phone}} </option>
                            @endforeach
                        </select>
                    </div>            
                </div>
                <div class="row row-item">
                    <div class="col-lg-4 col-sm-4 col-md-4 col-12">
                        <label for="order-type">Mặt hàng</label> 
                    </div>
                    <div class="col-lg-8 col-sm-8 col-md-8 col-12">
                        <?php $products = App\Product::all() ; ?>
                        <select class="form-control selectpicker" name="product_id">
                            @foreach($products as $product)
                            <option value="{{$product->id}}">{{$product->name}} </option>
                            @endforeach
                        </select>
                    </div>                 
                </div>
                {{-- <div class="row row-item">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                            <label for="date">Chọn ngày</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-12">
                            <input id="ngay" class="form-control" type="date" name="date" data-date-format="mm/dd/yyyy">
                        </div>               
                </div>    --}}
            </div>
            <div class="form-group col-lg-6 col-md-6 col-12">               
                <div class="row row-item">
                    <div class="col-lg-3 col-sm-3 col-md-3 col-12">
                        <label for="type">Đơn vị</label> 
                    </div>
                    <div class="col-lg-9 col-sm-9 col-md-9 col-12">
                        <select class="form-control selectpicker" name="unit">
                            <option value="m3">Mét khối</option>
                            <option value="ton">Tấn</option>
                        </select>
                    </div>                  
                </div>
                <div class="row row-item">
                    <div class="col-lg-3 col-sm-3 col-md-3 col-12">
                        <label for="amount">Khối lượng</label> 
                    </div>
                    <div class="col-lg-9 col-sm-9 col-md-9 col-12">
                        <input id="amount" class="form-control money" name="amount" required>
                    </div>                  
                </div>
                <div class="row row-item">
                    <div class="col-lg-3 col-sm-3 col-md-3 col-12">
                        <label for="sotien">Số tiền</label> 
                    </div>
                    <div class="col-lg-9 col-sm-9 col-md-9 col-12">
                        <input id="charge" class="form-control money" name="charge" required>
                    </div>                  
                </div>
                <div class="row row-item">
                    <div class="col-lg-3 col-sm-3 col-md-3 col-12">
                        <label for="tratruoc">Thanh toán</label> 
                    </div>
                    <div class="col-lg-9 col-sm-9 col-md-9 col-12">
                        <input id="payment_amount" class="form-control money" name="payment_amount" required>
                    </div>                  
                </div>
            </div>              
        </div>
        <div class="row row-item justify-content-center">
            <button type="submit" class="btn btn-info">Tạo giao dịch</button>
        </div>
    </form> 
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('select').select2({
            }
            );          
            // var today = new Date();
            // var dd = today.getDate();
            // var mm = today.getMonth()+1; //January is 0!
            // var yyyy = today.getFullYear();
            // if(dd<10){
            //         dd='0'+dd
            //     } 
            //     if(mm<10){
            //         mm='0'+mm
            //     } 

            // today = yyyy+'-'+mm+'-'+dd;
            // document.getElementById("ngay").setAttribute("min", today);
            // document.getElementById("ngay").setAttribute("value", today)
            new AutoNumeric(document.getElementById("amount"), [AutoNumeric.getPredefinedOptions.floatPos]); 
            new AutoNumeric(document.getElementById("charge"), [AutoNumeric.getPredefinedOptions().integerPos]	);
            new AutoNumeric(document.getElementById("payment_amount"), [AutoNumeric.getPredefinedOptions().integerPos]	);   
        });
    </script>
@endsection