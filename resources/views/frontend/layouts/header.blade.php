<!DOCTYPE html>
<html lang="zxx">

<head>
  <meta charset="utf-8" />
  <title>Blarkafin - Finance & Insurance Company</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta content="Blarkafin - Insurance and Finance Company" name="description" />
  <meta content="" name="keywords" />
  <meta content="" name="author" />
  <meta name="base-url" content="{{ url('/') }}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="canonical" href="https://blarkafin.com/" />
  <!-- CSS Files
    ================================================== -->
  <link href="{{asset('assets/css/loan.css')}}" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <link href="{{ asset('assets/css/jpreloader.css')}}" rel="stylesheet" type="text/css" />
  <link id="bootstrap" href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
  <link id="bootstrap-grid" href="{{ asset('assets/css/bootstrap-grid.min.css') }}" rel="stylesheet" type="text/css" />
  <link id="bootstrap-reboot" href="{{ asset('assets/css/bootstrap-reboot.min.css') }}" rel="stylesheet"
    type="text/css" />
  <link href="{{asset('assets/css/animate.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{asset('assets/css/owl.carousel.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{asset('assets/css/owl.theme.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{asset('assets/css/owl.transitions.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{asset('assets/css/magnific-popup.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{asset('assets/css/jquery.countdown.css')}}" rel="stylesheet" type="text/css" />

  <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css" />
  <link rel="icon" href="{{asset('assets/images/fevicon.png')}}" type="image/x-icon" />
  <link rel="shortcut icon" href="{{asset('assets/images/fevicon.png')}}" type="image/x-icon" />
  <script src="https://kit.fontawesome.com/26ba1f541e.js" crossorigin="anonymous"></script>

  <!-- color scheme -->
  <link id="colors" href="{{asset('assets/css/colors/scheme-05.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{asset('assets/css/coloring.css')}}" rel="stylesheet" type="text/css" />
  <style>
    .swiper {
      width: 90%;
      height: 100%;
      margin: auto !important;
    }

    .swiper-slide {
      /* margin: auto !important; */
      text-align: center;
      font-size: 18px;
      background: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
      /* border: solid red 1px; */
      border-radius: 5px;
    }

    .swiper- img {
      display: block;
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 5px;
    }
  </style>
</head>

<body>
  <div id="wrapper">
    <!-- header begin -->
    <div id="topbar" class="text-light">
      <div class="container">
        <div class="topbar-left sm-hide">
          <span class="topbar-widget tb-social">
            <a href="https://facebook.com/BlarkaFin" target="_blank"><i class="fa fa-facebook"></i></a>
            <a href="https://www.instagram.com/blarkafin/" target="_blank"><i class="fa fa-instagram"></i></a>
          </span>
        </div>

        <div class="topbar-right">
          <div class="topbar-right">
            @if(Auth::check())
            <span class="topbar-widget"><a href="/dashboard">Dashboard</a></span>
            <span class="topbar-widget"> <form id="logoutForm" action="{{ route('logout') }}" method="POST">
              @csrf
              <button  type="submit">Logout</button>
          </form></span>
            @else
            <span class="topbar-widget"><a href="/login">Login</a></span>
            @endif

          
          
            <span class="topbar-widget"><a href="/register">Register</a></span>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
    <header class="transparent">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="de-flex sm-pt10">
              <div class="de-flex-col">
                <!-- logo begin -->
                <div id="logo">
                  <a href="/">
                    <img alt="" class="logo" src="{{asset('assets/images/logo-light.png')}}" />
                    <img alt="" class="logo-2" src="{{asset('assets/images/logo.png')}}" />
                  </a>
                </div>
                <!-- logo close -->
              </div>
              <div class="de-flex-col header-col-mid">
                <!-- mainmenu begin -->
                <ul id="mainmenu">
                  <li>
                    <a href="/">Home<span></span></a>
                  </li>

                  <li>
                    <a href="/credit">Credit cards<span></span></a>
                  </li>
                  <li>
                    <a href="#">Insurance<span></span></a>
                    <ul>
                      <li>
                        <a href="/life-insurance">Life Insurance</a>
                      </li>
                      <li>
                        <a href="/general-insurance">General Insurance</a>
                      </li>
                      <li>
                        <a href="/health-insurance">Health Insurance</a>
                      </li>
                    </ul>
                  </li>
                  <li>
                    <a href="/loan-service">Loan<span></span></a>
                  </li>

                  <li>
                    <a href="/demat/create">Demat Account<span></span></a>
                  </li>
                </ul>
              </div>
              <div class="de-flex-col">
                <!-- <div class="h-phone "><span>Need&nbsp;Help?</span><i class="fa fa-phone id-color-secondary"></i> <a href="tel:+91 8341683476">+91-8341683476</a></div> -->
                <span id="menu-btn"></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>