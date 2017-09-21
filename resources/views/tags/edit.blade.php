@extends('main')

@section('title', "- Edit $tag->name Tag")

@section('content')

	{!! Form::model($tag, ['route' => ['tags.update', $tag->id], 'method' => 'PUT']) !!}
		{{ Form::label('name', 'Title') }}
		{{ Form::text('name', null, ['class' => 'form-control']) }}

		{{ Form::submit('Save', ['class' => 'btn btn-success btn-sm', 'style' => 'margin-top:10px;']) }}
	{!! Form::close() !!}
@stop