@extends('layouts.app')
@section('css')
    
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="/khachhang/list">Khách hàng</a></li>
            <li class="breadcrumb-item active" aria-current="page">Thêm mới</li>
        </ol>
    </nav>
    <div class="justify-content-center" style="width:100%">
            
            <form method="POST" action="/khachhang/create">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="row-item gray-bg round-corner" style="text-align: center">
                            <label>Nhập thông tin khách hàng</label>
                        </div>
                        <div class="row-item" style="display:{{ $warning == 'none' ? "none" : "block" }}">
                            <span class="badge badge-danger">{{$warning}}</span>
                        </div>
                        <div class="row-item">
                            <input class="form-control" type="text" name="ten" placeholder="Nhập tên" required>
                        </div>
                        <div class="row-item">
                            <input class="form-control" type="text" name="sdt" placeholder="Nhập số điện thoại" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="row-item justify-content-center gray-bg round-corner" style="text-align: center">
                            <Label>Tỷ lệ ăn</Label>
                        </div>
                        <div class="row row-item">
                            <div class="col-sm-6 col-6">
                                <label>Đề</label>                        
                            </div>
                            <div class="col-sm-6 col-6" >
                                <input class="form-control" type="number" name="rateD" value="70" required>
                            </div>                  
                        </div>
                        <div class="row row-item">
                            <div class="col-sm-6 col-6">
                                <label>Lô</label>                        
                            </div>
                            <div class="col-sm-6 col-6">
                                <input class="form-control" type="number" name="rateL" step=".1" value="3.5" required>
                            </div>                  
                        </div>
                        <div class="row row-item">
                            <div class="col-sm-6 col-6">
                                <label>3 càng</label>                        
                            </div>
                            <div class="col-sm-6 col-6" >
                                <input class="form-control" type="number" name="rateBC" value="450" required>
                            </div>                  
                        </div>
                        <div class="row row-item">
                            <div class="col-sm-6 col-6">
                                <label>Lô xiên 2</label>                        
                            </div>
                            <div class="col-sm-6 col-6">
                                <input class="form-control" type="number" name="rateLx2" value="10" required>
                            </div>                  
                        </div>
                        <div class="row row-item">
                            <div class="col-sm-6 col-6">
                                <label>Lô xiên 3</label>                        
                            </div>
                            <div class="col-sm-6 col-6">
                                <input class="form-control" type="number" name="rateLx3" value="40" required>
                            </div>                  
                        </div>
                        <div class="row row-item">
                            <div class="col-sm-6 col-6">
                                <label>Lô xiên 4</label>                        
                            </div>
                            <div class="col-sm-6 col-6">
                                <input class="form-control" type="number" name="rateLx4" value="100" required>
                            </div>                  
                        </div>
                    </div>
                </div>               
                <div class="row-item">
                    <button type="submit" class="btn btn-info">Tạo khách hàng</button>
                </div>
            </form>
    </div>
    
@endsection
