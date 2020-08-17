<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Hệ thống quản lý mỏ</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script type="text/javascript"  src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <!-- ...or, you may also directly use a CDN :-->
    <script src="https://cdn.jsdelivr.net/npm/autonumeric@4.5.4"></script>

    <!--Chart Script-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha512-s+xg36jbIujB2S2VKfpGmlC3T5V2TF3lY48DX7u2r9XzGzgPsa6wTpOQA7J9iffvdeBN0q9tKzRxVxw1JviZPg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.js" integrity="sha512-G8JE1Xbr0egZE5gNGyUm1fF764iHVfRXshIoUWCTPAbKkkItp/6qal5YAHXrxEu4HNfPTQs6HOu3D5vCGS1j3w==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js" integrity="sha512-vBmx0N/uQOXznm/Nbkp7h0P1RfLSj0HQrFSzV8m7rOGyj30fYAOKHYvCNez+yM8IrfnW0TCodDEjRqf6fodf/Q==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.css" integrity="sha512-SUJFImtiT87gVCOXl3aGC00zfDl6ggYAw5+oheJvRJ8KBXZrr/TMISSdVJ5bBarbQDRC2pR5Kto3xTR0kpZInA==" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js" integrity="sha512-QEiC894KVkN9Tsoi6+mKf8HaCLJvyA6QIRzY5KrfINXYuP9NxdIkRQhGq3BZi0J4I7V5SidGM3XUQ5wFiMDuWg==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" integrity="sha512-/zs32ZEJh+/EO2N1b0PEdoA10JkdC3zJ8L5FTiQu82LR9S/rOQNfQN7U59U9BC12swNeRAz3HSzIL2vpp4fv3w==" crossorigin="anonymous" />
    
    @yield('css')
    <style>
      .dashboard-stat {
            padding:20px;
            font-size: 1.5vh;
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
            body, .table {
                font-size: 3vw;
            }
            input {
                font-size: 4vw;
            }
            h3 {
                font-size: 7vw;
            }
            .footer {
                display: none;
            }
            .form-control {
                font-size: 0.7rem;
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
        .select2-container .select2-selection--single {
            height: calc(1.5em + .75rem + 2px);
            padding: .375rem .75rem;
        }
        li, .badge, a {
            font-size: 1.3vh;
        }
        h3 {
            font-size: 3vh;
        }

    </style>
    
</head>
<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
            <a class="navbar-brand" href="{{ url('/') }}">
                Smart Mine
            </a>
            

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown"> 
                        <a class="nav-link dropdown-toggle" href="#" id="khdropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Khách hàng</a>
                        <div class="dropdown-menu" aria-labelledby="khdropdown">
                            <a class="dropdown-item" href="/customer/list">
                                Danh sách khách hàng
                            </a>
                            <a class="dropdown-item" href="/customer/create" style="display:{{Auth::user()->hasSalerPermission()? 'block' : 'none'}}">
                                Thêm khách hàng mới
                            </a>
                            <a class="dropdown-item" href="/customer/accounts">
                                Dư nợ khách hàng
                            </a>
                        </div>

                    </li>
                    <li class="nav-item dropdown"> 
                        <a class="nav-link dropdown-toggle" href="#" id="lenhdropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Giao dịch</a>
                        <div class="dropdown-menu" aria-labelledby="lenhdropdown">
                            <a class="dropdown-item" href="/order/index">
                                Lịch sử giao dịch
                            </a>
                            <a class="dropdown-item" href="/order/create" style="display:{{Auth::user()->hasSalerPermission()? 'block' : 'none'}}">
                                Giao dịch mới
                            </a>
                        </div>
                    </li>

                    <li class="nav-item dropdown"> 
                        <a class="nav-link dropdown-toggle" href="#" id="tcdropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Thanh toán</a>
                        <div class="dropdown-menu" aria-labelledby="tcdropdown">
                            <a class="dropdown-item" href="/payment/index">
                                Lịch sử thanh toán
                            </a>
                            <a class="dropdown-item" href="/payment/create" style="display:{{Auth::user()->hasSalerPermission()? 'block' : 'none'}}">
                                Thanh toán mới
                            </a>
                        </div>

                    </li>

                    <li class="nav-item dropdown"> 
                        <a class="nav-link dropdown-toggle" href="#" id="cpdropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Chi phí</a>
                        <div class="dropdown-menu" aria-labelledby="cpdropdown">
                            <a class="dropdown-item" href="/expense/index">
                                Danh sách chi phí
                            </a>
                            <a class="dropdown-item" href="/expense/create" style="display:{{Auth::user()->hasSalerPermission()? 'block' : 'none'}}">
                                Thêm chi phí mới
                            </a>
                        </div>

                    </li>

                    <li class="nav-item dropdown"> 
                        <a class="nav-link dropdown-toggle" href="#" id="product_dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sản phẩm</a>
                        <div class="dropdown-menu" aria-labelledby="product_dropdown">
                            <a class="dropdown-item" href="/product/index">
                                Danh sách sản phẩm
                            </a>
                            <a class="dropdown-item" href="/product/create" style="display:{{Auth::user()->hasAdminPermission()? 'block' : 'none'}}">
                                Thêm sản phẩm mới
                            </a>
                        </div>

                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Đăng nhập') }}</a>
                        </li>
                    @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                    @endif 
                    @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/user/index" style="display:{{Auth::user()->hasRole('ROLE_ADMIN')? 'block' : 'none'}}">
                                Danh sách người dùng
                            </a>
                            <a class="dropdown-item" href="/user/changePassword" >
                                Đổi mật khẩu
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Đăng xuất') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>

                    </li>
                        
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="container" style="margin-top: 70px;margin-bottom:150px;">
        @yield('content')
    </div>
    @include('layouts.footer')
    <script>
            $(document).ready(function() {
                $('.table-dt').DataTable( {
                  "language": {        
                      "sProcessing":   "Đang xử lý...",
                      "sLengthMenu":   "Xem _MENU_ mục",
                      "sZeroRecords":  "Không có kết quả nào",
                      "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
                      "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
                      "sInfoFiltered": "(được lọc từ _MAX_ mục)",
                      "sInfoPostFix":  "",
                      "sSearch":       "Tìm:",
                      "sUrl":          "",
                      "oPaginate": {
                        "sFirst":    "Đầu",
                        "sPrevious": "Trước",
                        "sNext":     "Tiếp",
                        "sLast":     "Cuối"
                      }
                  },
                  "paging": true,           
                  "autoWidth": true,
                  "info": false,
                  "lengthChange": false,
                  "pageLength": 10,
                } );
            } );
        </script>
    @yield('script')
</body>
</html>
