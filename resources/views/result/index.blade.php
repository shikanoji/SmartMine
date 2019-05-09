@extends('layouts.app')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/home">Trang chủ</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tra cứu kết quả</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12 col-sm-8 col-lg-8">
            <form method="POST" action="/result/filter">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-7 col-sm-7 col-lg-7">
                        <input id="ngay" class="form-control" type="date" value={{ isset($deresult)? $deresult->ngay : (isset($ngay)? $ngay : date('Y-m-d'))}} name="ngay" data-date-format="dd/mm/yyyy">
                    </div>
                    <div class="col-5 col-sm-5 col-lg-5">
                        <button class="btn btn-info" type="submit">Lấy kết quả</button>
                    </div>
                </div>
            </form>
        </div>       
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-6">
            <div class="row row-item">
                    <div class=" portlet-title gray-bg round-corner col-lg-12">
                        <label style="margin-left:0; margin-right:auto;margin-top:5px;">Kết quả xổ số đặc biệt</label>
                    </div>
            </div>
            <div class="row justify-content-center">               
                <label class="redtext">{{ isset($deresult)? $deresult->ketqua : 'Không có kết quả' }}</label>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-6">
            <div class="row row-item">
                    <div class=" portlet-title gray-bg round-corner col-lg-12">
                        <label style="margin-left:0; margin-right:auto;margin-top:5px;">Kết quả lô</label>
                    </div>
            </div>
            <div class="row justify-content-center" style="display:{{isset($los)? 'none' : 'block'}};text-align:center;">
                <label class="redtext">Không có kết quả</label>
            </div>
            <div class="row justify-content-center" style="display:{{isset($los)? 'block' : 'none'}};" >
                <div class="col-12 col-sm-12 col-lg-12">
                    <table class="table table-bordered" id="lostable">
                        <tbody >
                            @for ($i = 0; $i < 3; $i++)
                            <tr>
                                <td >{{$los[$i*9 + 0]}}</td>
                                <td >{{$los[$i*9 + 1]}}</td>
                                <td >{{$los[$i*9 + 2]}}</td>
                                <td >{{$los[$i*9 + 3]}}</td>
                                <td >{{$los[$i*9 + 4]}}</td>
                                <td >{{$los[$i*9 + 5]}}</td>
                                <td >{{$los[$i*9 + 6]}}</td>
                                <td >{{$los[$i*9 + 7]}}</td>
                                <td >{{$los[$i*9 + 8]}}</td>
                            </tr>
                            @endfor                
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </div>
    <div class="row justify-content-center">
        <button class="btn btn-info"><a style="color:white;" href="/result/updateScore">Cập nhật kết quả hôm nay</a></button>
    </div>
@endsection