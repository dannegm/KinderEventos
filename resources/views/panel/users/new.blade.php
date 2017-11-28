@extends('panel.template')

@section('breadcrumb')
	<li>Inicio</li>
	<li><a href="{{route('users.index')}}">Usuarios</a></li>
	<li class="active">Nuevo</li>
@stop

@section('scripts')
	<script>
	@if($errors->any())
	$(function () {
		$('#modal-errors').modal('show');
	});
	@endif
	</script>
@stop

@section('content')
	<div class="content">
		<!-- Formulario -->
		
		<form action="{{route('users.create')}}" method="post" enctype="multipart/form-data">
		{{ csrf_field() }}
		<div class="row">
			<div class="col-md-6 col-sm-8 col-xs-12">
				<div class="block">
					<div class="block-content">
						<div class="form-group">
							<div class="form-material">
								<label>Nombre</label>
								<input class="form-control input-lg" type="text" name="name" placeholder="Nombre" value="{{old('name')}}">
							</div>
						</div>

						<div class="form-group">
							<label>Email</label>
							<input class="form-control" type="text" name="email" placeholder="email" value="{{old('email')}}">

						</div>
						<div class="form-group">
							<label>Nueva Contraseña</label>
							<input class="form-control" type="password" name="password" placeholder="contraseña" value="">
						</div>

						<div class="form-group" style="border-top: 1px solid #eee; margin-top: 20px; padding-top: 20px;">
							<input class="btn btn-primary" type="submit" value="Añadir"/>
							<a href="{{route('users.index')}}" class="btn btn-default" role="button">Cancelar</a>
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