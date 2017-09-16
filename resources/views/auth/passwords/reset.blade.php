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
					{!! Form::open(['url' => 'password/reset', 'method' => "POST"])	!!}

						{{ Form::hidden('token', $token) }}
						
						{{ Form::label('email', 'Email address:') }}
						{{ Form::email('email', $email, ['class' => 'form-control']) }}

						{{ Form::label('password', 'New password:')}}
						{{ Form::password('password', ['class' => 'form-control']) }}

						{{ Form::label('password_confirmation', 'Confirm new password:')}}
						{{ Form::password('password_confirmation', ['class' => 'form-control']) }}

						{{ Form::submit('Reset pasword', ['class' => 'btn btn-primary btn-block', 'style' => 'margin-top: 20px;']) }}

					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@stop