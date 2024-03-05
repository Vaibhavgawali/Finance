<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Insurancecareer.in</title>
	<meta name="description" content="Insurancecareer.in - Insurance Company">
	<meta name="keywords" content="	accounting, advising, advisory, business, company, consulting, corporate, finance, financial, investments, law, multi-purpose, services, tax help, visual composer">
	<meta name="author" content="Zynovvatech">
	<link rel="shortcut icon" href="/admin-assets/assets/images/logomini.png" type="image/x-icon">
	<meta name="base-url" content="{{ url('/') }}">
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/fontawesome-all.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/flaticon.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/video.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/slick-theme.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/nice-select.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/rs6.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/roundslider.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/global.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body class="insurin-main">
	<div id="preloader"></div>
	<div class="up">
		<a href="#" class="scrollup text-center"><i class="fas fa-chevron-up"></i></a>
	</div>
	
<!-- Start of header section
	============================================= -->
	<header id="in-header" class="in-header-section header-style-six">
		
		<div class="in-header-top-content ">
			<div class="brand-logo d-flex p-2 align-items-center">
				<a href="/"><img src="{{asset('assets/img/logo/logo1.png')}}" alt=""></a>
				<marquee class="top-text-scroll" style="margin-left:40px;" direction="right" scrollamount="3">Empower Your Future: Navigate the Insurance Career Landscape with us  </marquee> 
			</div>
			

		</div>
		
		<div class="ins-header-main-navigation-area d-flex align-items-center justify-content-between">
			<div class="ins-header-sidenav-cta d-flex align-items-center">
				<div class="in-sidebar-btn navSidebar-button">
					<span></span>
					<span></span>
					<span></span>
					<span></span>
				</div>
				<div class="ins-nav-cta d-flex align-items-center">
					<span><img src="{{asset('assets/img/logo/fire.svg')}}" alt=""></span> Hot Line: + <a href="tel:011-44748705">011-44748705</a>
				</div>
			</div>
			<div class="main-navigation-menu">
				<nav class="in-main-navigation-area clearfix ul-li">
					<ul id="main-nav" class="nav navbar-nav clearfix">
						<li class="dropdown in-megamenu">
							<a href="/">Home</a>
						</li>
						<li><a target="" href="/about">About Us</a></li>
						<li class="dropdown">
						<a href="javascript:void(0)">Insights</a>
							<ul class="dropdown-menu clearfix">
								<li><a  href="/industry">About Industry</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a class="btn  custom-btn p-2" href="javascript:void(0)">Register</a>
							<ul class="dropdown-menu clearfix">
								<li><a   href="/candidate-register">Candidate</a></li>
								<li><a  href="/insurer-register">Insurer</a></li>
								<li><a  href="/institute-register">Institute</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a class="btn custom-btn p-2" href="javascript:void(0)">Login</a>
							<ul class="dropdown-menu clearfix">
								<li><a   href="/login?role=candidate">Candidate</a></li>
								<li><a  href="/login?role=insurer">Insurer</a></li>
								<li><a  href="/login?role=institute">Institute</a></li>
							</ul>
						</li>
					</ul>
				</nav>
			</div>
		</div>
		<div class="mobile_menu position-relative">
			<div class="mobile_menu_button open_mobile_menu">
				<i class="fal fa-bars"></i>
			</div>
			<div class="mobile_menu_wrap">
				<div class="mobile_menu_overlay open_mobile_menu"></div>
				<div class="mobile_menu_content">
					<div class="mobile_menu_close open_mobile_menu">
						<i class="fal fa-times"></i>
					</div>
					<div class="m-brand-logo">
						<a  href="/"><img src="assets/img/logo/logo-1.png" alt=""></a>
					</div>
					<nav class="mobile-main-navigation  clearfix ul-li">
						<ul id="m-main-nav" class="nav navbar-nav clearfix">
							<li class=" in-megamenu">
								<a href="/">Home</a>
							</li>
							
							<li><a  href="/about">About Us</a></li>
							<li class="dropdown">
							<a href="javascript:void(0)">Insights</a>
								<ul class="dropdown-menu clearfix">
									<li><a  href="/industry">About Industry</a></li>
									<li><a  href="/module">Module</a></li>
								</ul>
							</li>
							<li class="dropdown">
							<a class="btn custom-btn p-2" href="javascript:void(0)">Register</a>
							<ul class="dropdown-menu clearfix">
								<li><a   href="/candidate-register">Candidate</a></li>
								<li><a  href="/insurer-register">Insurer</a></li>
								<li><a  href="/institute-register">Institute</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a class="btn custom-btn p-2" href="javascript:void(0)">Login</a>
							<ul class="dropdown-menu clearfix">
								<li><a   href="/login">Candidate</a></li>
								<li><a  href="/login">Insurer</a></li>
								<li><a  href="/login">Institute</a></li>
							</ul>
						</li>
						</ul>
					</nav>
				</div>
			</div>
			<!-- /Mobile-Menu -->
		</div>
	</header>
	<!-- Sidebar sidebar Item -->
	
<!-- Start of header section
	============================================= -->
