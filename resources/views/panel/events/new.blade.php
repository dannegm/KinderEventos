@extends('panel.template')

@section('styles')
	<link rel="stylesheet" href="{{URL::asset('/oneui/js/plugins/bootstrap-datepicker/bootstrap-datepicker3.min.css')}}">
@stop

@section('scripts')
	<script src="{{URL::asset('/oneui/js/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
	<script src="{{URL::asset('/oneui/js/plugins/bootstrap-datetimepicker/moment.min.js')}}"></script>
	<script>
	$(function () {
		$('.js-datepicker').add ('.input-daterange').datepicker ({
			weekStart: 1,
			autoclose: true,
			todayHighlight: true
		});
	});

	@if($errors->any())
	$(function () {
		$('#modal-errors').modal ('show');
	});
	@endif
	</script>
@stop

@section('content')
	<div class="content">
		<!-- Formulario -->
		
		<form action="{{ route ('events.create') }}" method="post">
		{{ csrf_field() }}
		<div class="row">
			<div class="col-md-6 col-sm-8 col-xs-12">
				<div class="block">
					<div class="block-content push-items">
						<div class="form-group push-30">
							<div class="form-material">
								<label>Nombre del Evento</label>
								<input class="form-control input-lg" type="text" name="name" value="{{ old ('name') }}">
							</div>
						</div>

						<div class="form-group push-30">
							<div class="form-material">
								<label>Lugar</label>
								<input class="form-control" type="text" name="place" value="{{ old ('place') }}">
							</div>
						</div>

						<div class="form-group push-30">
								<label>Fechas del evento</label>
								<input class="js-datepicker form-control push-10" type="text" name="started_at" data-date-format="yyyy-mm-dd" placeholder="Inicia" value="{{ old ('started_at') }}" />
								<input class="js-datepicker form-control" type="text" name="ended_at" data-date-format="yyyy-mm-dd" placeholder="Termina" value="{{ old ('ended_at') }}" />
						</div>

						<div class="form-group push-30">
							<div class="form-material">
								<label>Información adicional</label>
								<textarea class="form-control" name="description" placeholder="Comentarios adicionales acerca del evento">{{ old ('description') }}</textarea>
							</div>
						</div>

						<div class="form-group push-30" style="border-top: 1px solid #eee; margin-top: 20px; padding-top: 20px;">
							<button class="btn btn-primary">Añadir</button>
							<a href="{{route('events.index')}}" class="btn btn-default" role="button">Cancelar</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		</form>

	</div>
@stop

@section('modals')

	@if($errors->any())
		<div class="modal" id="modal-errors" tabindex="-1" role="dialog" aria-hidden="true">
		    <div class="modal-dialog">
		        <div class="modal-content">
		            <div class="block block-themed remove-margin-b">
		                <div class="block-header bg-danger">
		                    <ul class="block-options">
		                        <li>
		                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
		                        </li>
		                    </ul>
		                    <h3 class="block-title">Verfica lo siguiente</h3>
		                </div>
		                <div class="block-content">
		                	<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
		            </div>
		            <div class="modal-footer">
		                <button class="btn btn-sm btn-primary" type="button" data-dismiss="modal">Aceptar</button>
		            </div>
		        </div>
		    </div>
		</div>
	@endif
@stop