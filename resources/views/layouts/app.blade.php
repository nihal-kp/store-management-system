<!doctype html>
<html class="no-js" lang="en">
   <head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Store Management System</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Store Management System">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <meta property="og:title" content="Store Management System">
    <meta property="og:description" content="Store Management System">
    <meta property="og:image" content="{{asset('assets/front/images/store-og.webp') }}">
    <link rel="shortcut icon" type="image/webp" href="{{asset('assets/front/images/favi-icon.webp') }}"/>
    <!-- Place favicon.ico in the root directory -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/vendor.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/fonts/feather.css') }}">
<!--       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
 -->
     
</head>
<body>
    <div class="main-wrapper">
    <div class="app" id="app">
        <div class="sidebar-header">
        <div class="brand">
        <div class="logo">
            <h2>Stores</h2>
        </div>
        </div>
        </div>
        
        <header class="header">
            <div class="header-block header-block-collapse d-lg-none d-xl-none">
                <button class="collapse-btn" id="sidebar-collapse-btn">
                <i class="feather-menu"></i>
                </button>
            </div>
            <div class="header-block header-block-nav">
                <ul class="nav-profile">
                    
                    <li class="profile dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <!-- <div style="float: left;margin-top:-1px;">
                           <div class="img" style="background-image: url('/assets/front/images/user.png')"> </div>
                        </div> -->
                        <span style="font-weight: 300;" class="name">Hi <?php echo Auth::guard('customer')->user()->name; ?>,</span><br>
                        <span class="name" style="top:-10px;"> Welcome </span>
                    </a>
                    <div class="dropdown-menu profile-dropdown-menu" aria-labelledby="dropdownMenu1">
                        <a class="dropdown-item" href="logout">
                        <i class="feather-logout"></i> Logout </a>
                    </div>
                    </li>
                </ul>
            </div>
        </header>      

        <aside class="sidebar">
            <div class="sidebar-container">
        
                <nav class="menu">
                    <ul class="sidebar-menu metismenu" id="sidebar-menu">
                        <li>
                        <a href="{{ route('welcome') }}"  class="{{ request()->is('/') ? 'active-menu' : '' }}">
                            <img src="{{ asset('assets/front/images/home.png') }}">
                            Home 
                        </a>
                    </li>
                    
                    <li>
                        <a href="{{ route('settings') }}" class="{{ request()->is('settings') || request()->is('settings/*') ? 'active-menu' : '' }}">
                        <img src="{{ asset('assets/front/images/settings.png') }}">
                        Settings
                        </a>
                    </li>
                    </ul>
                </nav>
            </div>
            <footer class="sidebar-footer">
                <ul class="sidebar-menu metismenu" id="customize-menu">
                </ul>
            </footer>
        </aside>

        @yield('content')

    </div>
    </div>
     
    <script src="{{ asset('assets/front/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/vendor.js') }}"></script>
    <script src="{{ asset('assets/front/js/app.js') }}"></script>

    @stack('scripts')

</body>
</html>