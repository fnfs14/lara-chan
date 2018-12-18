<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="apple-touch-icon" sizes="180x180" href="{{ chan::favicon('apple-touch-icon.png') }}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{ chan::favicon('favicon-32x32.png') }}">
	<link rel="icon" type="image/png" sizes="192x192" href="{{ chan::favicon('android-chrome-192x192.png') }}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{ chan::favicon('favicon-16x16.png') }}">
	<link rel="manifest" href="{{ chan::favicon('site.webmanifest') }}">
	<link rel="mask-icon" href="{{ chan::favicon('safari-pinned-tab.svg') }}" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#2d89ef">
	<meta name="msapplication-TileImage" content="{{ chan::favicon('mstile-144x144.png') }}">
	<meta name="theme-color" content="#ffffff">

    <title>Lara-chan</title>

    <!-- Bootstrap -->
    <link href="{{ chan::vendor('bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ chan::vendor('font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- jQuery custom content scroller -->
    <link href="{{ chan::vendor('malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css') }}" rel="stylesheet"/>

    <!-- Custom Theme Style -->
    <link href="{{ chan::build('css/custom.min.css') }}" rel="stylesheet">
    <link href="{{ chan::css('my.css') }}" rel="stylesheet">
	
	@stack('styles')
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{ route(chan::getMainPage()) }}" class="site_title">
				<img src="{{ chan::img('unknownmine-transparent-white.png') }}" width="50" />
				&nbsp;
				<span>Lara-chan</span>
			  </a>
            </div>

            <div class="clearfix"></div>

            <br />

            <!-- sidebar menu -->
			@include('admin.layouts.' . chan::sidebar())
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
			@include('admin.layouts.footer-button')
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
		@include('admin.layouts.header')
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
			@yield('alert')
			@yield('content')
			@yield('modal')
        </div>
        <!-- /page content -->

        <!-- footer content -->
		@include('admin.layouts.footer')
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="{{ chan::vendor('jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ chan::vendor('bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ chan::vendor('fastclick/lib/fastclick.js') }}"></script>
    <!-- jQuery custom content scroller -->
    <script src="{{ chan::vendor('malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{ chan::build('js/custom.min.js') }}"></script>
    <script src="{{ chan::js('my.js') }}"></script>
	@stack('scripts')
  </body>
</html>
