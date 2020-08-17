@extends('layouts.app')
@section('css')
@endsection
@section('content')
    <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="/expense/index">Chi phí</a></li>
                <li class="breadcrumb-item active" aria-current="page">Thêm chi phí</li>
            </ol>
    </nav>
    <form method="POST" action="/expense/store">
    {{csrf_field()}}
        <div class="row row-item justify-content-center">           
            <div class="form-group col-lg-6 col-md-8 col-12">  
                <div class="row row-item">
                    <div class="col-lg-3 col-sm-3 col-md-3 col-12">
                            <label for="content">Nội dung</label> 
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 col-12">
                        <textarea class="form-control" type="text" name="content" maxlength="200" row="3" required></textarea>
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