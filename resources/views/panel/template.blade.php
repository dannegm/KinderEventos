<!DOCTYPE html>
<!--[if IE 9]>         <html class="ie9 no-focus"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-focus"> <!--<![endif]-->
<head>
	<meta charset="utf-8">

	<title>{{$title}} | Dashboard</title>

	<meta name="author" content="@dannegm">
	<meta name="robots" content="noindex, nofollow">
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">

	<!-- Icons -->
	<link rel="shortcut icon" href="{{URL::asset('/oneui/img/favicons/favicon.png')}}">

	<link rel="icon" type="image/png" href="{{URL::asset('/oneui/img/favicons/favicon-16x16.png')}}" sizes="16x16">
	<link rel="icon" type="image/png" href="{{URL::asset('/oneui/img/favicons/favicon-32x32.png')}}" sizes="32x32">
	<link rel="icon" type="image/png" href="{{URL::asset('/oneui/img/favicons/favicon-96x96.png')}}" sizes="96x96">
	<link rel="icon" type="image/png" href="{{URL::asset('/oneui/img/favicons/favicon-160x160.png')}}" sizes="160x160">
	<link rel="icon" type="image/png" href="{{URL::asset('/oneui/img/favicons/favicon-192x192.png')}}" sizes="192x192">

	<link rel="apple-touch-icon" sizes="57x57" href="{{URL::asset('/oneui/img/favicons/apple-touch-icon-57x57.png')}}">
	<link rel="apple-touch-icon" sizes="60x60" href="{{URL::asset('/oneui/img/favicons/apple-touch-icon-60x60.png')}}">
	<link rel="apple-touch-icon" sizes="72x72" href="{{URL::asset('/oneui/img/favicons/apple-touch-icon-72x72.png')}}">
	<link rel="apple-touch-icon" sizes="76x76" href="{{URL::asset('/oneui/img/favicons/apple-touch-icon-76x76.png')}}">
	<link rel="apple-touch-icon" sizes="114x114" href="{{URL::asset('/oneui/img/favicons/apple-touch-icon-114x114.png')}}">
	<link rel="apple-touch-icon" sizes="120x120" href="{{URL::asset('/oneui/img/favicons/apple-touch-icon-120x120.png')}}">
	<link rel="apple-touch-icon" sizes="144x144" href="{{URL::asset('/oneui/img/favicons/apple-touch-icon-144x144.png')}}">
	<link rel="apple-touch-icon" sizes="152x152" href="{{URL::asset('/oneui/img/favicons/apple-touch-icon-152x152.png')}}">
	<link rel="apple-touch-icon" sizes="180x180" href="{{URL::asset('/oneui/img/favicons/apple-touch-icon-180x180.png')}}">

	@section('styles-oneui')
	@show

	<!-- Stylesheets -->
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600,700%7COpen+Sans:300,400,400italic,600,700">
	<link rel="stylesheet" href="{{URL::asset('/oneui/css/bootstrap.min.css')}}">
	<link rel="stylesheet" id="css-main" href="{{URL::asset('/oneui/css/oneui.min.css')}}">
	@section('styles')
	@show

</head>
<body>
	@if( isset( $sidebar_mini ) )
	<div id="page-container" class="header-navbar-fixed">
	@else
	<div id="page-container" class="header-navbar-fixed">
	@endif

		<!-- Header -->
		<header id="header-navbar" class="content-mini content-mini-full">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12">
					<!-- Header Navigation Right -->
					<ul class="nav-header pull-right">
						<li>
							<a class="btn btn-success btn-noborder btn-rounded btn-xs" href="{{ route('pages.download') }}">Descargar APP</a>
						</li>

						<li>
							<a class="btn btn-primary btn-noborder btn-rounded btn-xs" href="{{ route('events.index') }}">Eventos</a>
						</li>

						@if(Auth::check())
						<li>
							<a class="btn btn-primary btn-noborder btn-rounded btn-xs" href="{{ route('users.index') }}">Usuarios</a>
						</li>
						@endif
						@if(Auth::check())
							<li>
								<div class="btn-group">
									<button class="btn btn-default dropdown-toggle" data-toggle="dropdown" type="button">
										<span class="hidden-xs">{{Auth::user()->name}}&nbsp;</span>
										<span class="hidden-sm hidden-md hidden-lg"><i class="si si-user"></i>&nbsp;</span>
										<span class="caret"></span>
									</button>
									<ul class="dropdown-menu dropdown-menu-right">
										<li>
											<a href="{{ route('users.edit', [Auth::user()->id]) }}">
												<i class="si si-user pull-right"></i>Perfil
											</a>
										</li>
										<li class="divider"></li>
										<li>
											<a href="{{ route('login.logout') }}">
												<i class="si si-logout pull-right"></i>Salir
											</a>
										</li>
									</ul>
								</div>
							</li>
						@else
							<li>
								<div class="btn-group">
									<a class="btn btn-default" href="{{ route('login.login') }}">
										<span>Iniciar sesión</span>
									</a>
								</div>
							</li>
						@endif
					</ul>

					<!-- Header Navigation Left -->
					<ul class="nav-header pull-left">
						<li>
							<h2 class="font-w300 hidden-xs">Eventos <span class="text-city hidden-sm">Kinder Sorpresa</span>
								<span class="text-city hidden-md hidden-lg">KS</span></h2>
							<h2 class="font-w300 hidden-sm hidden-md hidden-lg">E<span class="text-city">KS</span></h2>
						</li>
					</ul>

				</div>
			</div>
		</header>

		<!-- Main Container -->
		<main id="main-container">
			<!-- Page Header -->
			<div id="title-container" class="content bg-gray-lighter">
				<div class="row items-push">
					<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12">

						<div class="row col-md-6 col-sm-6 col-xs-6">
							<h1 class="page-heading font-w300">
								{{$title}}
							</h1>
						</div>
						<div class="row col-md-6  col-sm-6 col-xs-6 pull-right">
							@section('toolbar')
							@show
						</div>
					</div>
				</div>
			</div>

			<!-- Page Content -->
			
			<div class="row items-push">
				<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12">
				@section('content')
				@show
			</div>
		</div>

		</main>
		<!-- END Main Container -->

		<!-- Footer -->
		<footer id="page-footer" class="content-mini content-mini-full font-s12 bg-gray-lighter clearfix">
			<div class="pull-left">
			</div>
		</footer>
	</div>

	@section('modals')
	@show

	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script src="{{URL::asset('/oneui/js/oneui.min.js')}}"></script>
	@section('scripts')
	@show
</body>
</html>