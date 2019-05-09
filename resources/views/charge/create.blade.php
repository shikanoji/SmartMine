@extends('layouts.app')
@section('css')
@endsection
@section('content')
    <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="/khachhang/accounts">Quản lý nợ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Thanh toán</li>
            </ol>
    </nav>
    <form method="POST" action="/charge/create">
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
                            <option value="{{$customer->id}}" {{($customer->id == $customerNo) ? "selected" : ""}}>{{$customer->customerName}} - {{$customer->sdt}} </option>
                            @endforeach
                        </select>
                    </div>            
                </div>           
                <div class="row row-item">
                    <div class="col-lg-3 col-sm-3 col-md-3 col-12">
                        <label for="chargeMoney">Số tiền</label> 
                    </div>
                    <div class="col-lg-9 col-sm-9 col-md-9 col-12">
                        <input class="form-control" type="number" name="chargeMoney" required>
                    </div>                  
                </div>
                <div class="row row-item">
                        <div class="col-lg-3 col-sm-3 col-md-3 col-12">
                                <label for="noteselect">Nội dung</label> 
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-9 col-12">
                            <select id="noteselect" class="form-control" name="note" required>                              
                                <option value="Thanh toán">Thanh toán</option>
                                <option value="Trả thưởng">Trả thưởng</option>
                            </select>
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
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth() + 1; //January is 0!
            var yyyy = today.getFullYear();
            if(dd<10){
                    dd='0'+dd
            } 
            if(mm<10){
                mm='0'+mm
            } 

            today = yyyy+'-'+mm+'-'+dd;
            document.getElementById("ngay").setAttribute("min", today);
            document.getElementById("ngay").setAttribute("value", today);

        });

        function changeCustomer(account) {
            console.log(account);
             document.getElementById("account").value = account;               
        }
    </script>
@endsection