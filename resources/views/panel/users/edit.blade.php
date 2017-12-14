@extends('panel.template')

@section('breadcrumb')
	<li>Inicio</li>
	<li><a href="{{route('users.index')}}">Usuarios</a></li>
	<li>Editar</li>
	<li class="active">{{$user->name}}</li>
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
		<form action="{{route('users.update', ['id' => $user->id])}}" method="POST">
			{{ csrf_field() }}
			<div class="row">
				<div class="col-md-6 col-sm-8 col-xs-12">
				<!-- Formulario -->
					<div class="block">
						<div class="block-content">
							<div class="form-group">
								<div class="form-material">
									<label>Nombre</label>
									<input class="form-control input-lg" type="text" name="name" placeholder="Nombre" value="{{$user->name}}">
								</div>
							</div>

							<div class="form-group">
								<label>Email</label>
								<input class="form-control" type="text" name="email" placeholder="email" value="{{$user->email}}">

							</div>
							<div class="form-group">
								<label>Nueva Contraseña</label>
								<input class="form-control" type="password" name="password" placeholder="contraseña" value="">
							</div>


							@if(Auth::user()->id != $user->id)
							<div class="form-group" style="border-top: 1px solid #eee; margin-top: 20px; padding-top: 20px;">

								<button class="btn btn-primary" type="submit">Guardar</button>
								<a href="{{route('users.index')}}" class="btn btn-default" role="button">Regresar</a>

								<a href="{{route('users.delete', ['id' => $user->id])}}" class="btn btn-danger" role="button">Eliminar</a>

							</div>
							@else
							<div class="form-group" style="border-top: 1px solid #eee; margin-top: 20px; padding-top: 20px;">
								<button class="btn btn-primary" type="submit">Guardar</button>
								<a href="{{route('users.index')}}" class="btn btn-default" role="button">Cancelar</a>
							</div>
							@endif
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







