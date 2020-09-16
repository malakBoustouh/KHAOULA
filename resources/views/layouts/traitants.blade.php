<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> معالجة @yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href=" {{ asset('plugins/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/bootstrap-rtl.min.css') }}">
    <!-- template rtl version -->
    <link rel="stylesheet" href="{{ asset('dist/css/custom-style.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <script src="{{ asset('https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js') }}"></script>
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js') }}"></script>
    <script src="{{ asset('https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js') }}"></script>
    <link href="{{ asset('https://fonts.googleapis.com/css2?family=Tajawal&display=swap') }}" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{asset('https://fonts.googleapis.com/css2?family=Tajawal&display=swap')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css')}}">
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <script src="{{ asset('https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js') }}"></script>

    <nav class="main-header navbar navbar-expand  navbar-light border-bottom">
        <!-- Left navbar links -->
        <ul class="navbar-nav">

            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell-o"></i>
                    <span class="badge badge-danger navbar-badge"> {{\App\Notificationtrait::select('notificationtraits.detail')->join('traitants', 'traitants.id_traitant', '=', 'notificationtraits.traitant_id')->
    where('traitants.user_id',Auth::user()->id)-> where('notificationtraits.etat',1) ->count()}}</span>
                </a>



                <?php
                    $notes = DB::table('traitants')
                    ->leftJoin('notificationtraits', 'traitant_id', 'traitants.id_traitant')
                    ->where('traitants.user_id', Auth::user()->id)
                    ->orderBy('notificationtraits.created_at', 'desc')
                    ->get();
                ?>
                <ul class="dropdown-menu" role="menu" style="width:350px">
                    <span class="dropdown-item dropdown-header">ملاحظات الآباء</span>
                    <div class="dropdown-divider"></div>

                    @foreach($notes as $note)
                        <a >
                            @if($note->etat==1)
                                <li style="background:#E4E9F2; padding:10px">
                            @else
                                <li style="padding:10px">
                                    @endif
                                    <div class="row">
                                        <a href="{{url('/notifications')}}/{{$note->id}}" class="dropdown-item">

                                            <div class="col-md-12">
                                                <i class="fa fa-envelope ml-2"></i>
                                                <span  style="color:#000; font-size:90%">{{$note->detail}}</span>
                                                <span  style="color:#000; font-size:90%" class="float-left text-muted text-sm"> {{\Carbon\Carbon::parse($note->created_at)->diffForHumans(null,true)}}</span>

                                            </div>
                                        </a>
                                    </div>

                                </li></a>

                    @endforeach
                    <div class="dropdown-divider"></div>

                    <a href="#" class="dropdown-item dropdown-footer">مشاهدة الإشعارات</a>
                    </ul>




            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav mr-auto">
            <img  style="margin-top: 7px" src="{{ asset('dist/img/logoautisme.png')}}"  >

        </ul>
    </nav>

    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">


        <!-- Sidebar -->
        <div class="sidebar" style="direction: ltr">
            <div style="direction: rtl">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        @if(\Illuminate\Support\Facades\Auth::user()->image)
                            <img class="user-img" style="width:60px;height:60px;"src="{{ asset('storage/traitants/'.\Illuminate\Support\Facades\Auth::user()->image) }}"  alt="Avatar" style="width:70px;height: 50px"/>
                        @endif
                    </div>
                    <div class="info">
                        <a href="#" class="d-block" >{{\Illuminate\Support\Facades\Auth::user()->name}}</a>
                        <a href="#"><i style="padding-left:5px;" class="fa fa-circle text-success"></i>متصل </a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                             with font-awesome or any other icon font library -->
                        <?php
                        $segment=Request::segment(2);
                        //echo $segment;


                        ?>
                        <li class="nav-item has-treeview">
                            <a href="{{route('pagetraitant')}}" class="nav-link  @if(!$segment )active @endif">
                                <i class="nav-icon fa fa-user-plus"></i>
                                <p>
                                    حصة معالجة
                                </p>
                            </a>

                        </li>


                        <li class="nav-item">

                        <li class="nav-item has-treeview">
                            <a href="{{route('pagetraitant.seancetraitements.index')}}" class="nav-link  @if($segment=='seancetraitements' )active @endif">
                                <i class="nav-icon fa fa-table"></i>
                                <p>
                                    قائمة الأطفال
                                </p>
                            </a>

                        </li>




                        <li class="nav-item">
                            <a href="{{ route('logout') }}" id="lien" class="nav-link @if($segment=='logout') active @endif" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="nav-icon fa fa-sign-out"></i>
                                <p>
                                    تسجيل الخروج
                                </p>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>



                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('partials._messages')
        @yield('content')
        <br>
        <br>
        <br>
        <br> <br>
        <br>

        @include('partials._footer')

    </div>
</div>


</body>
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>

<!-- jQuery UI 1.11.4 -->
<script src="{{asset('https://code.jquery.com/ui/1.12.1/jquery-ui.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>
</html>
