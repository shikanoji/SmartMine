@extends('layouts.app')
@section('css')
@endsection
@section('content')
    <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="/customer/accounts">Quản lý khách hàng</a></li>
                <li class="breadcrumb-item active" aria-current="page">Khách hàng thanh toán</li>
            </ol>
    </nav>
    @isset($payment)
    <div class="row row-item justify-content-center"> 
            <div class="col-lg-6 col-md-8 col-12" >
                <div class="alert alert-success" role="alert">
                    Thanh toán thành công </br>
                    Khách hàng : {{ App\Customer::findOrFail($payment->customer_id)->name}} </br>
                </div>
            </div>
    </div>
    @endisset
    <form method="POST" action="/payment/store">
    {{csrf_field()}}
        <div class="row row-item justify-content-center">           
            <div class="form-group col-lg-6 col-md-8 col-12">  
                <div class="row row-item">
                    <div class="col-lg-3 col-sm-3 col-md-3 col-12">
                        <label for="customerSelect">Khách</label> 
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 col-12">
                        <?php $customerNo = isset($customerId)? $customerId : 1 ; ?>
                        <select id="customerSelect" class="selectpicker form-control" name="customer_id" required>
                            @foreach($customers as $customer)
                            <option value="{{$customer->id}}" {{($customer->id == $customerNo) ? "selected" : ""}}>{{$customer->name}} - {{$customer->phone}} </option>
                            @endforeach
                        </select>
                    </div>            
                </div>           
                <div class="row row-item">
                    <div class="col-lg-3 col-sm-3 col-md-3 col-12">
                        <label for="amount">Số tiền</label> 
                    </div>
                    <div class="col-lg-9 col-sm-9 col-md-9 col-12">
                        <input class="form-control money" name="amount" required>
                    </div>                  
                </div>
                <div class="row row-item">
                        <div class="col-lg-3 col-sm-3 col-md-3 col-12">
                                <label for="noteselect">Ghi chú</label> 
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-9 col-12">
                            <input class="form-control" type="text" name="note" required>
                        </div>            
                </div>
            </div>              
        </div>
        <div class="row row-item justify-content-center">
            <button type="submit" class="btn btn-info">Thanh toán</button>
        </div>
    </form> 
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('select').select2({});     
            new AutoNumeric('.money', [AutoNumeric.getPredefinedOptions().integerPos]);    
        });

        function changeCustomer(account) {
            console.log(account);
             document.getElementById("account").value = account;               
        }

    </script>
@endsection