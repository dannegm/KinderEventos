@extends('panel.template')

@section('toolbar')
	<div class="btn-group pull-right">
		<a href="{{route('users.new')}}" class="btn btn-default" role="button">Nuevo usuario</a>
	</div>
@stop

@section('content')
	<div class="content">
		<div class="row">
		@foreach($users as $u)
			<div class="col-sm-6 col-md-4 col-lg-3">
				<a class="block block-link-hover2" href="{{route('users.edit', ['id' => $u->id])}}">
					<div class="block-content block-content-full text-center">
						<div class="font-w600 push-5">{{$u->name}}</div>
						<div class="text-muted">{{$u->email}}</div>
					</div>
				</a>
			</div>
		@endforeach
		</div>
	</div>
@endsection


