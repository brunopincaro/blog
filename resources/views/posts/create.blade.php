@extends('main')

@section('title', '- create new post')

@section('stylesheets')
	{!! Html::style('css/parsley.css') !!}
	{!! Html::style('css/select2.min.css') !!}
	<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=uq8y2r1sp169la0l8nlw9qcyevls79tzpsgwmgytjgcy3gl4"></script>
	<script>
		tinymce.init({
			selector:'textarea',
            plugins: "link code image imagetools",
            menubar: false
		});
	</script>
@stop

@section('content')

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>Create new post</h1>
			<hr>

			{!! Form::open(array('route' => 'posts.store', 'data-parsley-validate' => '', 'files' => true)) !!}
    			{{ Form::label('title', "Title:") }}
    			{{ Form::text('title', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}

				{{ Form::label('slug', 'Slug:') }}
				{{ Form::text('slug', null, array('class' => 'form-control', 'required' => '', 'minlength' => '5', 'maxlength' => '64' )) }}

				{{ Form::label('category_id', 'Category:') }}
				<select name="category_id" class="form-control">
					@foreach($categories as $category)
						<option value="{{ $category->id }}">{{ $category->name }}</option>
					@endforeach
				</select>

				{{ Form::label('featured_image', 'Upload the featured image') }}
				{{ Form::file('featured_image', ['class' => 'form-control-file']) }}

				{{ Form::label('tags', 'Tags:') }}
				<select name="tags[]" class="form-control select2-multi" multiple="multiple">
					<?php /* We name it as "category_id" to match the column on the posts table */ ?>
					@foreach($tags as $tag)
						<option value="{{ $tag->id }}">{{ $tag->name }}</option>
					@endforeach
				</select>

				{{ Form::label('body', "Post:")}}
				{{ Form::textarea('body', null, array('class' => 'form-control')) }}

				{{ Form::submit('Create post', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top:20px')) }}
			{!! Form::close() !!}
		</div>
	</div>

@stop

@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
	{!! Html::script('js/select2.min.js') !!}

	<script>
		$('.select2-multi').select2();
	</script>
@stop
