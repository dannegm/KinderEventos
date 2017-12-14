@extends('panel.template')

@section('toolbar')
@stop

@section('styles')
<style>
#title-container {
	display: none;
}
#main-container {
	background: #fff;
}
</style>
@stop

@section('scripts')
@stop

@section('content')
	<div class="content">
		<div class="row items-push">
			<div class="col-lg-12">
				<h1 class="font-w300">Descarga la aplicación</h1>
			</div>

			@if ($agent->isDesktop())
			<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
				<a href="/downloads/ios/kinder.ipa" class="btn btn-noborder btn-info btn-rounded btn-lg btn-block">
					<i class="fa fa-apple"></i> Para iPhone</a>
				</a>
			</div>
			<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
				<a href="/downloads/android/kinder.apk" class="btn btn-noborder btn-success btn-rounded btn-lg btn-block">
					<i class="fa fa-android"></i> Para Android</a>
				</a>
			</div>
			@endif

			@if ($agent->is ('Android'))
			<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
				<a href="/downloads/android/kinder.apk" class="btn btn-noborder btn-success btn-rounded btn-lg btn-block">
					<i class="fa fa-android"></i> Para Android</a>
				</a>
			</div>
			@endif

			@if (($agent->isMobile() || $agent->isTablet()) && $agent->isSafari ())
			<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
				<a href="itms-services://?action=download-manifest&amp; url=https://kinder-eventos.dnn.one/downloads/ios/AdhocDistribution.plist" class="btn btn-noborder btn-info btn-rounded btn-lg btn-block">
					<i class="fa fa-apple"></i> Para iPhone</a>
				</a>
			</div>
			@endif
		</div>
	</div>
@stop
