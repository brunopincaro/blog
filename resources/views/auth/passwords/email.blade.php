@extends('main')

@section('title', '- Forgot password')

@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					Reset password
				</div>
				<div class="panel-body">
					@if(session('status'))
						<div class="alert alert-success">
							{{ session('status') }}
						</div>
					@endif

					{!! Form::open(['route' => 'password.email', 'method' => "POST"])	!!}
						
						{{ Form::label('email', 'Email address:') }}
						{{ Form::email('email', null, ['class' => 'form-control']) }}

						{{ Form::submit('Reset pasword', ['class' => 'btn btn-primary btn-block', 'style' => 'margin-top: 20px;']) }}

					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@stop