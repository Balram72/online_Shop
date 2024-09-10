<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('page_title')</title>
    <link rel="icon" type="image/x-icon" href="{{asset('storage/media/ss.png')}}">
    <link href="{{ asset('admin_assets/css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset ('admin_assets/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset ('admin_assets/vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
    <link rel="stylesheet" href="{{ asset('https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.css') }}">
    <link href="{{ asset ('admin_assets/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('admin_assets/vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('admin_assets/vendor/css-hamburgers/hamburgers.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('admin_assets/css/theme.css')}}" rel="stylesheet" media="all">
</head>
<body>
        
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="#">
                            <img src="{{asset('storage/media/ss.png')}}" alt="" width="250px">
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="@yield('dashboard_select')">
                           <a href="{{ url('admin/dashboard')}}">
                               <i class="fas fa-tachometer-alt"></i>Dashboard
                            </a>
                        </li>
                        <li class="@yield('category_select')">
                         <a href="{{ url('admin/category')}}">
                            <i class="fas fa-list"></i>Category
                          </a>
                        </li>
                        <li class="@yield('coupon_select')">
                            <a href="{{ url('admin/coupon')}}">
                               <i class="fas fa-tag"></i>Coupon
                             </a>
                        </li>
                        <li class="@yield('size_select')">
                            <a href="{{ url('admin/size')}}">
                               <i class="fas fa-window-maximize"></i>Size
                             </a>
                        </li>
                        <li class="@yield('color_select')">
                            <a href="{{ url('admin/color')}}">
                                <i class="fa fa-tint"></i>
                                Color
                             </a>
                        </li>
                        <li class="@yield('brand_select')">
                            <a href="{{ url('admin/brand')}}">
                                <i class="fa fa-bold"></i>
                                Brands
                             </a>
                        </li>
                        <li class="@yield('brand_select')">
                            <a href="{{ url('admin/tax')}}">
                                <i class="fa fa-percent"></i>
                                Tax
                             </a>
                        </li>
                        <li class="@yield('product_select')">
                            <a href="{{ url('admin/product')}}">
                                <i class="fa fa-product-hunt"></i>
                                Product
                             </a>
                        </li>
                        <li class="@yield('home_banner_select')">
                            <a href="{{ url('admin/home_banner')}}">
                                <i class="fas fa-images"></i>
                                    Home Banner
                             </a>
                        </li>
                        <li class="@yield('customers_select')">
                            <a href="{{ url('admin/customer')}}">
                                <i class="fa fa-user"></i>
                                Customers
                             </a>
                        </li>
                        <li class="@yield('customers_select')">
                            <a href="{{ url('admin/order')}}">
                                <i class="fa fa-user"></i>
                                Order
                             </a>
                        </li>
                        <li class="@yield('offers_select')">
                            <a href="{{ url('admin/offers')}}">
                                <i class="fa fa-gift"></i>
                                Special Offer
                             </a>
                        </li>
                        <li class="@yield('contact_select')">
                            <a href="{{ url('admin/contact')}}">
                                <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                               FeedBack
                             </a>
                        </li>
                     
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->
    
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="{{asset('storage/media/ss.png')}}" alt="">
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        
                        <li class="@yield('dashboard_select')">
                            <a href="{{ url('admin/dashboard')}}">
                                <i class="fas fa-tachometer-alt"></i>Dashboard
                            </a>
                        </li>
                        <li class="@yield('category_select')">
                            <a href="{{ url('admin/category')}}">
                                <i class="fas fa-list"></i>Category
                            </a>
                        </li>
                        <li class="@yield('product_review_select')">
                            <a href="{{ url('admin/product_review')}}">
                                <i class="fa fa-star"></i>
                                Product Review
                             </a>
                        </li>
                        <li class="@yield('order_select')">
                            <a href="{{ url('admin/order')}}">
                                <i class="fa fa-shopping-basket"></i>
                                Order
                             </a>
                        </li>
                        <li class="@yield('coupon_select')">
                            <a href="{{ url('admin/coupon')}}">
                               <i class="fas fa-tag"></i>Coupon
                             </a>
                        </li>
                        <li class="@yield('size_select')">
                            <a href="{{ url('admin/size')}}">
                                <i class="fas fa-window-maximize"></i>Size
                             </a>
                        </li>
                        <li class="@yield('color_select')">
                            <a href="{{ url('admin/color')}}">
                                <i class="fa fa-tint"></i>Color
                             </a>
                        </li>
                        <li class="@yield('brand_select')">
                            <a href="{{ url('admin/brand')}}">
                                <i class="fa fa-bold"></i>
                                Brands
                             </a>
                        </li>
                        {{-- <li class="@yield('brand_select')">
                            <a href="{{ url('admin/tax')}}">
                                <i class="fa fa-percent"></i>
                                Tax
                             </a>
                        </li> --}}
                        <li class="@yield('product_select')">
                            <a href="{{ url('admin/product')}}">
                                <i class="fa fa-product-hunt"></i>
                                Product
                             </a>
                        </li>
                        <li class="@yield('home_banner_select')">
                            <a href="{{ url('admin/home_banner')}}">
                                <i class="fas fa-images"></i>
                                    Home Banner
                             </a>
                        </li>
                        <li class="@yield('customers_select')">
                            <a href="{{ url('admin/customer')}}">
                                <i class="fa fa-user"></i>
                                Customers
                             </a>
                        </li>
                        <li class="@yield('offers_select')">
                            <a href="{{ url('admin/offers')}}">
                                <i class="fa fa-gift"></i>
                                Special Offer
                             </a>
                        </li>
                        <li class="@yield('contact_select')">
                            <a href="{{ url('admin/contact')}}">
                                <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                                               FeedBack
                             </a>
                        </li>
                     
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap float-right">
                            <div class="header-button" >
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="content">
                                            <a class="js-acc-btn" href="#">Welcome Admin</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-account"></i>Account</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="{{ url('admin/logout')}}">
                                                    <i class="zmdi zmdi-power"></i>Logout
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->
    
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                         @yield('container')
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>
    </div>

    <script src="{{ asset('admin_assets/vendor/jquery-3.2.1.min.js')}}"></script>
    <script src="{{ asset('admin_assets/vendor/bootstrap-4.1/popper.min.js')}}"></script>
    <script src="{{ asset('admin_assets/vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>
    <script src="{{ asset('admin_assets/vendor/wow/wow.min.js')}}"></script>
    <script src="{{ asset('admin_assets/js/main.js')}}"></script>

    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $(".alert").alert('close');
            }, 3000); 
        });
    </script>
</body>
</html>
