@extends('panel.template')

@section('toolbar')
	<form class="form-inline pull-left" action="{{ route ('events.findByEmail') }}">
		<div class="input-group">
			<div class="input-group-addon"><i class="fa fa-search"></i></div>
			<input name="email" class="form-control" type="text" placeholder="Buscar por email...">
		</div>
	</form>
				
	@if(Auth::check())
		<div class="btn-group pull-right">


			<a href="{{ route ('events.edit', [ 'id' => $event->id ]) }}" class="btn btn-default" type="button">Editar</a>
			<a href="#" class="btn btn-default" data-action="delete-event" data-id="{{$event->id}}"><i class="fa fa-trash-o"></i></a>
		</div>
	@endif
@stop

@section('styles')
	<link rel="stylesheet" href="{{URL::asset('/oneui/js/plugins/sweetalert/sweetalert.min.css')}}">
@stop

@section('scripts')
	<script src="{{URL::asset('/oneui/js/plugins/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
	<script src="{{URL::asset('/oneui/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
	<script>
	$(function () {
		$('[data-action="delete-event"]').on ('click', function (e) {
			e.preventDefault ();
			var id = $(this).data ('id');
			swal({
				title: '',
				text: '¿Estás seguro de borrar este evento?',
				showCancelButton: true,
				confirmButtonColor: '#d26a5c',
				confirmButtonText: 'Sí, bórrala',
				closeOnConfirm: false,
				html: false
			}, function (result) {
				console.log(result);
				if (result) {
					window.location.href = '/event/' + id + '/delete';
				}
			});
		});
		$('[data-action="delete-picture"]').on ('click', function (e) {
			e.preventDefault ();
			var md5 = $(this).data ('md5');
			swal({
				title: '',
				text: '¿Estás seguro de borrar este evento?',
				showCancelButton: true,
				confirmButtonColor: '#d26a5c',
				confirmButtonText: 'Sí, bórrala',
				html: false
			}, function (result) {
				console.log(result);
				if (result) {
					var API = '{{route ('pictures.delete')}}';
					$.post (API, { md5: md5 }, function () {
						$('.picture[data-md5="' + md5 + '"]').remove ();
					});
				}
			});
		});
		$('[data-action="sendByEmail"]').on ('click', function (e) {
			e.preventDefault ();
			var md5 = $(this).data ('md5');
			var API = '{{route ('pictures.senByEmail')}}';
			$.post (API, { md5: md5 }, function () {
				$.notify({
					icon: 'fa fa-paper-plane',
					message: 'Se ha mandado la foto por email.'
				}, {
					element: 'body',
					type: 'success',
					allow_dismiss: true,
					placement: {
						from: 'bottom',
						align: 'center'
					},
					offset: 20,
					spacing: 10,
					z_index: 1031,
					timer: 1000,
					animate: {
						enter: 'animated fadeInUp',
						exit: 'animated fadeOutDown'
					},
					icon_type: 'class'
				});
			})
			.fail (function () {
				$.notify({
					icon: 'fa fa-paper-plane',
					message: 'No se pudo mandar la foto por email.'
				}, {
					element: 'body',
					type: 'warning',
					allow_dismiss: true,
					placement: {
						from: 'bottom',
						align: 'right'
					},
					offset: 20,
					spacing: 10,
					z_index: 1031,
					timer: 1000,
					animate: {
						enter: 'animated fadeInUp',
						exit: 'animated fadeOutDown'
					},
					icon_type: 'class'
				});
			});
		});

		$('[data-action="print"]').on ('click', function (e) {
			e.preventDefault ();
			var pic_path = $(this).data ('path');
			var md5 = $(this).data ('md5');
			var API = '{{route ('pictures.setAsPrinted')}}';
			$.post (API, { md5: md5 }, function () {
				var win = window.open ('');
				win.document.write('<img src="' + pic_path + '" onload="window.print();window.close()" />');
				win.focus();
			});
		});
	});
	</script>
@stop

@section('content')
	<div class="content">
		<div class="row items-push">
			@forelse($pictures as $picture)
			<div class="col-sm-4 col-xs-6 picture" data-md5="{{$picture->md5}}">
				<div class="block">
					<img class="img-responsive" src="{{ asset('/pictures/' . $picture->filename ) }}">
					<div class="block-header">
						@if(Auth::check())
							<ul class="block-options">
								<li>
									<a href="#" data-action="sendByEmail" data-md5="{{$picture->md5}}">
										<i class="si si-paper-plane"></i>
									</a>
								</li>
								<li>
									<a href="{{ asset('/pictures/' . $picture->filename ) }}" download>
										<i class="si si-arrow-down"></i>
									</a>
								</li>
								<li>
									<a href="#" data-action="delete-picture" data-md5="{{$picture->md5}}">
										<i class="si si-trash"></i>
									</a>
								</li>
							</ul>
						@else
							<ul class="block-options">
								<li>
									<a href="{{ asset('/pictures/' . $picture->filename ) }}" download>
										<i class="si si-arrow-down"></i>
									</a>
								</li>
							</ul>
						@endif
						<h3 class="block-title">{{ $picture->dateString () }}</h3>
					</div>
				</div>
			</div>
			@empty
				<div class="alert alert-info">
					<h3 class="font-w300 push-15">Sin fotos en el evento</h3>
					@if(Auth::check())
						<p>Invita a las personas a tomarse fotos desde la aplicación de Realidad Aumentada.</p>
					@else
						<p>Si estás en evento pregunta a tu anfitrión para que te tome una foto :)</p>
					@endif
				</div>
			@endforelse

			<div class="col-xs-12">
				<div class="pagination">{{$pictures->links()}}</div>
			</div>
		</div>
	</div>
@stop