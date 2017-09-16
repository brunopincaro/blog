@extends('main')

@section('title', "/ Blog / - $post->title ")

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>{{ $post->title }}</h1>
			<p>{{ $post->body }}</p>
			<hr>
			<p>Posted in: {{ $post->category->name }}</p>
			<?
				/*
				because there's a relationship between the tables posts and categories, we can access the information on the other table this way

				$post is an object of the Post model
				category property is the method Post's method category() that initiates the relationship 
				*/
			?>
		</div>
	</div>
@stop