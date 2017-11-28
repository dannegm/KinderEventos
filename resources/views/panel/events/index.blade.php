@extends('panel.template')

@section('toolbar')
	@if(Auth::check())
		<div class="btn-group pull-right">
			<a href="{{ route('events.new') }}" class="btn btn-default" type="button">Nuevo Evento</a>
		</div>
	@endif
@stop

@section('styles')
	<link rel="stylesheet" href="{{URL::asset('/oneui/js/plugins/sweetalert/sweetalert.min.css')}}">
@stop

@section('scripts')
	<script src="{{URL::asset('/oneui/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
	<script>
	$(function () {
		$('[data-action="delete"]').on ('click', function (e) {
			var id = $(this).data ('id');
			e.preventDefault ();
			swal({
				title: '',
				text: '¿Estás seguro de borrar este evento?',
				showCancelButton: true,
				confirmButtonColor: '#d26a5c',
				confirmButtonText: 'Sí, bórralo',
				closeOnConfirm: false,
				html: false
			}, function (result) {
				console.log(result);
				if (result) {
					window.location.href = '/event/' + id + '/delete';
				}
			});
		});
	});
	</script>
@stop

@section('content')
	<div class="content">
		<div class="row items-push">
			@forelse($events as $event)
			<div class="col-sm-12 remove-margin-b">
				<div class="block">
					<div class="block-header">
						@if(Auth::check())
						<ul class="block-options">
							<li>
								<a href="{{ route ('events.edit', [ 'id' => $event->id ]) }}">
									<i class="si si-pencil"></i>
								</a>
							</li>
							<li>
								<a href="#" data-action="delete" data-id="{{$event->id}}">
									<i class="si si-trash"></i>
								</a>
							</li>
						</ul>
						@endif
						<h3 class="font-w300 text-city">{{$event->name}}</h3>
					</div>
					<div class="block-content bg-gray-lighter">
						<p>
							<b><i class="glyphicon glyphicon-map-marker"></i> {{$event->place}}</b>
							&nbsp;&nbsp;&nbsp;
							<span>De {{$event->startedString()}} a {{$event->endededString()}}</span>

							<a class="text-success pull-right" href="{{ route ('events.event', [ 'permalink' => $event->permalink ]) }}">Ver evento</a>
							<span class="text-info pull-right push-10-r">{{$event->pictures->count ()}} fotos</span>
						</p>
					</div>
				</div>
			</div>
			@empty
				<div class="alert alert-info">
					<h3 class="font-w300 push-15">Sin próximos eventos</h3>
					@if(!Auth::check())
						<p>Como administrador puedes crear el primer evento desde <a href="{{ route('events.new') }}">aquí</a>.</p>
					@endif
				</div>
			@endforelse

			<div class="col-xs-12">
				<div class="pagination">{{$events->links()}}</div>
			</div>
		</div>
	</div>
@stop