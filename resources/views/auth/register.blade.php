@extends('main')

@section('title', '- Login')

@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			{!! Form::open() !!}

				{{ Form::label('name', "Name:") }}
				{{ Form::text('name', null, ['class' => 'form-control']) }}

				{{ Form::label('email', "Email:") }}
				{{ Form::email('email', null, ['class' => 'form-control']) }}

				{{ Form::label('password', "Pasword:") }}
				{{ Form::password('password', ['class' => 'form-control']) }}

				{{ Form::label('password_confirmation', "Pasword confirmation:") }}
				{{ Form::password('password_confirmation', ['class' => 'form-control']) }}

				<br>

				{{ Form::submit('Register', ['class' => 'btn btn-primary btn-block']) }}

			{!! Form::close() !!}
		</div>
	</div>
@stop