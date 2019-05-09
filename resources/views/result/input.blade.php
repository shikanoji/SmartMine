@extends('layouts.app')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/home">Trang chủ</a></li>
        <li class="breadcrumb-item active" aria-current="page">Nhập kết quả</li>
        </ol>
    </nav>
    <div class="alert alert-danger" role="alert" style="display:{{isset($message)? 'block': 'none'}}">
            {{isset($message)? $message : ''}}
    </div>
    <form method="POST" action="/result/store">
        {{csrf_field()}}
        <div class="row justify-content-center">     
            <div class="col-12 col-lg-6 col-sm-6">
                <div class="row row-item">
                    <div class="col-4 col-sm-4 col-lg-4" style="text-align:center;">
                        <label style="margin-top:5px;">Nhập ngày</label>
                    </div>
                    <div class="col-8 col-sm-8 col-lg-8">
                        <input id="ngay" class="form-control" type="date" value={{date("Y-m-d")}} name="ngay" data-date-format="dd/mm/yyyy" required>
                    </div>               
                </div>
                <div class="row row-item">
                    <div class="col-4 col-sm-4 col-lg-4" style="text-align:center;">
                        <label style="margin-top:5px;">Nhập giải đặc biệt</label>
                    </div>
                    <div class="col-8 col-sm-8 col-lg-8">
                        <input id="de" class="form-control" name="de" type="number" max="99999" required>
                    </div>               
                </div>
                <div class="row row-item">
                    <div class="col-4 col-sm-4 col-lg-4" style="text-align:center;">
                        <label style="margin-top:5px;">Nhập mã lô</label>
                    </div>
                    <div class="col-8 col-sm-8 col-lg-8">
                        <input id="de" class="form-control" name="lo" type="text" required>
                    </div>               
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <button class="btn btn-info" type="submit">Nhập kết quả</button>
        </div>
    </form>     
   
@endsection