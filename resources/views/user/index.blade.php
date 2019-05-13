@extends('layouts.app')
@section('content')
<nav aria-label="breadcrumb">
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/home">Trang chủ</a></li>
    <li class="breadcrumb-item active" aria-current="page">Người dùng</li>
</ol>
</nav>

<div class="row justify-content-center">
    <div class="col-12 col-lg-12 col-sm-12 col-md-12">
        <table class="table table-dt" id="customersTable" style="width:100%;text-align:center;">
            <thead class="thead-dark">
              <tr>
                <th scope="col"></th>
                <th scope="col">Tên</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
              </tr>
            </thead>
            <tbody>
              <?php $count = 0; ?>
              @foreach ($users as $user)
                <?php $count = $count + 1 ?>
                  <tr>
                    <th scope="row">{{$count}}</th>
                    <td><a href="/user/details/{{$user->id}}">{{$user->name}}</a></td>
                    <td>{{$user->email}}</td>
                    <td> 
                        {{$user->getRole()}}                                                                                 
                    </td>
                  </tr>
              @endforeach
              
            </tbody>
            <tfoot>
              <tr>
                <td colspan="4"><button type="button" class="btn btn-info" onclick="location.href='/user/create'">Thêm</button></td>
              </tr>
            </tfoot>
          </table>
    </div>  
</div>   

@endsection
