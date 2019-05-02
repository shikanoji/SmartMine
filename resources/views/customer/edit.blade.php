@extends('layouts.app')
@section('css')
    
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/khachhang/list">Khách hàng</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sửa thông tin</li>
        </ol>
    </nav>
    <div class="justify-content-center" style="width:100%">
            <form method="POST" action="/khachhang/update/{{$customer->id}}">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="row-item gray-bg round-corner">
                            <label>Thông tin khách hàng</label>
                        </div>
                        <div class="row-item">
                            <input class="form-control" type="text" placeholder="Nhập tên" name="ten" value="{{$customer->customerName}}" required>
                        </div>
                        <div class="row-item">
                            <input class="form-control" type="text" placeholder="Nhập sđt" name="sdt" value="{{$customer->sdt}}" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="row-item justify-content-center gray-bg round-corner">
                            <Label>Tỷ lệ ăn</Label>
                        </div>
                        <div class="row row-item">
                            <div class="col-sm-6 col-6">
                                <label>Đề</label>                        
                            </div>
                            <div class="col-sm-6 col-6" >
                                <input class="form-control" type="number" name="rateD" value="{{$customer->rateD}}" required>
                            </div>                  
                        </div>
                        <div class="row row-item">
                            <div class="col-sm-6 col-6">
                                <label>Lô</label>                        
                            </div>
                            <div class="col-sm-6 col-6">
                                <input class="form-control" type="number" name="rateL" value="{{$customer->rateL}}" required>
                            </div>                  
                        </div>
                        <div class="row row-item">
                            <div class="col-sm-6 col-6">
                                <label>3 càng</label>                        
                            </div>
                            <div class="col-sm-6 col-6" >
                                <input class="form-control" type="number" name="rateBC" value="{{$customer->rateBC}}" required>
                            </div>                  
                        </div>
                        <div class="row row-item">
                            <div class="col-sm-6 col-6">
                                <label>Lô xiên 2</label>                        
                            </div>
                            <div class="col-sm-6 col-6">
                                <input class="form-control" type="number" name="rateLx2" value="{{$customer->rateLx2}}" required>
                            </div>                  
                        </div>
                        <div class="row row-item">
                            <div class="col-sm-6 col-6">
                                <label>Lô xiên 3</label>                        
                            </div>
                            <div class="col-sm-6 col-6">
                                <input class="form-control" type="number" name="rateLx3" value="{{$customer->rateLx3}}" required>
                            </div>                  
                        </div>
                        <div class="row row-item">
                            <div class="col-sm-6 col-6">
                                <label>Lô xiên 4</label>                        
                            </div>
                            <div class="col-sm-6 col-6">
                                <input class="form-control" type="number" name="rateLx4" value="{{$customer->rateLx4}}" required>
                            </div>                  
                        </div>
                    </div>
                </div>
                <div class="row-item">
                    <button type="submit" class="btn btn-info">Cập nhật</button>
                    <button class="btn btn-danger">
                        <a onclick="return confirm('Xoá khách hàng ' + {{$customer->customerName}} + ' ?')" href="/khachhang/remove/{{$customer->id}}" style="color:white;">
                            Xoá khách hàng
                        </a> 
                    </button>
                </div>
            </form>
    </div>
@endsection
@section('script')
    <script>
        function deleteCustomer(){

        }
    </script>
@endsection