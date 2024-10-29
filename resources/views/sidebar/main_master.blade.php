<!doctype html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Daftung </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="{{ asset('style/images/1.1.png') }}">
    <link rel="shortcut icon" href="{{ asset('style/images/1.1.png') }}">
       <!-- {{-- {{ asset('style/'') }} --}} -->
    <link rel="stylesheet" href="{{asset('style/assets/css/normalize.css')}}">
    <link rel="stylesheet" href="{{asset('style/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('style/assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('style/assets/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('style/assets/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{asset('style/assets/css/cs-skin-elastic.css')}}">
    <link rel="stylesheet" href="{{asset('style/assets/scss/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
 
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
</head>

<body>   
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="{{asset('style/assets/js/vendor/jquery-2.1.4.min.js')}}"></script>
    <script src="{{asset('style/assets/js/popper.min.js')}}"></script>
    <script src="{{asset('style/assets/js/plugins.js')}}"></script>
    <script src="{{asset('style/assets/js/main.js')}}"></script>


        <!-- Left Panel -->

    <aside style="background-color:#68b1f0;" id="left-panel" class="left-panel ">
        <nav style="background-color:#68b1f0;" class="navbar navbar-expand-sm navbar-default ">
            <div class="navbar-header">
                           
                <a class="navbar-brand" href="">
                <img src="{{ asset('style/images/1.1.png') }}" alt="Brand icon" style="width: 80px; height:80px;" class="p-3">
                Daftung         
                </a>
                <a class="navbar-brand hidden" href=""><img src="{{ asset('style/images/1.1.png') }}" alt="Brand icon" style="width: 30px; height:30px;"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse mt-3">
                <ul class="nav navbar-nav  nav-underline flex-column  hidden">
                    <li class="menu-item-has-children">
                        <a class="nav-link active fw-bold me-3"  href="{{ url('home') }}"> <i class="menu-icon fa fa-home "></i><b>Home</b></a>
                    </li>
                    <li class=" menu-item-has-children">
                        <a class="nav-link fw-bold text-black me-3" href="{{ url('Transaksi') }}"> <i class="menu-icon fa fa-file-text-o"></i><b>Transaksi </b></a>
                    </li>
                    <li class="menu-item-has-children">
                        <a class="nav-link fw-bold text-black me-3" href="{{ url('laporan') }}"><i class="menu-icon fa fa-file"></i><b>Laporan Transaksi </b></a>
                    </li>                                    
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>

   
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <div class="header-menu">
                <div class="col-sm-7">
                    <a href="#">
                      <div class="pull-left" id="menuToggle" class="menutoggle pull-left">
                    <i class="fa fa-chevron-left"></i>  
                    </a>                                           
                </div>                   
            </div>
                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">                
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="{{ asset('style/images/admin.jpg') }}" alt="User Avatar">                        
                        </a>
                        <div class="user-menu dropdown-menu ">                                
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="nav-link" style="border: none; background: none; cursor: pointer;">
                                    <i class="fa fa-power-off"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                                
                </div>
            </div>

        </header>
        <!-- /header -->

        @yield('breadcrumbs')
        
        @yield('content')
       
      @yield('js')
       
    <!-- Right Panel -->   
    
    
</body>
</html>
