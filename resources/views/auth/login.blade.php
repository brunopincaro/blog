@extends('main')

@section('title', '- Login')

@section('content')
	<?php
		// must have csrf protection : without it login will fail
		// Manually : {!! csrf_field() !!}
		// Helpers : 
	?>

	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			{!! Form::open() !!}

				{{ Form::label('email', 'Email:') }}
				{{ Form::email('email', null, ['class' => 'form-control']) }}

				{{ Form::label('password', 'Password:') }}
				{{ Form::password('password', ['class' => 'form-control']) }}

				<br>

				{{ Form::checkbox('remember') }}
				{{ Form::label('remember', 'Remember me')}}

				<p>
					<a href="{{ url('password/reset') }}">
						Forgot password?
					</a>
				</p>

				{{ Form::submit('Login', ['class' => 'btn btn-primary btn-block']) }}

			{!! Form::close() !!}
		</div>
	</div>
@stop