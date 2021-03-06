<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Hệ thống quản lý khai thác mỏ</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
            .dashboard-stat {
                   padding:20px;
              }
            .greentext {
               color: #2ab4c0;
              }
            .redtext {
               color: #f36a5a;
              }
            .bluetext, a {
               color: #5C9BD1;
              }
             .purpletext {
               color: #8877a9;
              }
              .whitetext {
                  color: #fff,
              }
              .graytext {
                  color: #6c757d,
              }
              .row-item {
                  padding:10px;
              }
              .number {
                  text-align: center;
              }
              .gray-bg {
                  background-color: #e9ecef;
              }
              .border-bottom {
                  border-bottom: 1px solid #e7ecf1;
              }
              body, h1, h2, h3, h4, h5, h6 {
                  font-family: "Open Sans",sans-serif;
              }
              body {
                  overflow-x:hidden;
              }
              @media only screen and (max-width: 500px) {
                  body,div, .table {
                      font-size: 4vw;
                  }
              }
              .page-item.active .page-link {
                  background-color: #5C9BD1;
                  border-color: #5C9BD1;
              }
      
              .portlet {
                  margin-top:10px;
              }
              .round-corner {
                  border-radius: 5px;
              }
              .portlet-title {
                  min-height: 48px;
                  padding:10px;
                  border-bottom: 1px solid #e7ecf1;
                  text-align: center;
              }
              .portlet-body {
                  border-bottom: 1px solid #e7ecf1;
              }
              .select2 {
                  width:100%!important;
              }
          </style>
</head>
<body>
    <div style="height: 100vh; background-image: url('https://images.pexels.com/photos/2097855/pexels-photo-2097855.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260')">
        <div style="top:20vh;position:absolute;width:100%" >
            <div class="row justify-content-center" >
                <div class="col-lg-4  col-md-6 col-sm-10">
                    <div class="card" style="background-color: rgba(255,255,255,0.8)">
                    <div class="card-header" style="text-align: center;"><h4 class="redtext"><b>Hệ thống quản lý khai thác mỏ</b></h4></div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="username" class="col-md-4 col-form-label text-md-right">Tên đăng nhập</label>

                                <div class="col-md-6">
                                    <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>

                                    @if ($errors->has('username'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Mật khẩu</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Ghi nhớ') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Đăng nhập') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}" style="display:none;">
                                            {{ __('Quên mật khẩu?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
 </body>
</html>
