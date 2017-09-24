@extends('main')

@section('title', "- Blog / " . e($post->title))
<?php
	// escape the $post->title because of the xss
	// {{{ $data }}} is equivalent to < ?php echo e($data); ? >
	// e($data)
?>

@section('content')

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>{{ $post->title }}</h1>
			<p>{!! $post->body !!}</p>
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

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h3 class="comments-title"><span class="glyphicon glyphicon-comment"></span> {{ $post->comments()->count() }} Comments</h3>

			@foreach($post->comments as $comment)
				<div class="comment">
					<div class="auth-info">
						<img src="{{ "https://www.gravatar.com/avatar/" . md5(strtolower(trim($comment->email))) . "?s=50&d=mm" }}" alt="" class="author-image">

						<div class="author-name">
							<h4>{{ $comment->name }}</h4>
							<p class="author-time">{{ date("Y-m-d H:i", strtotime($comment->created_at)) }}</p>
						</div>
					</div>
					<div class="comment-content">
						{{ $comment->comment }}
					</div>
				</div>
			@endforeach
		</div>
	</div>

	<div class="row">
		<div id="comment-form" class="col-md-8 col-md-offset-2">

			<hr>

			<h3>Add a comment</h3>
			{!! Form::open(['route' => ['comments.store', $post->id], 'method' => 'POST']) !!}
				<div class="row well">
					<div class="col-md-6">
						{{ Form::label('name', 'Name:') }}
						{{ Form::text('name', null, ['class' => 'form-control']) }}
					</div>
					<div class="col-md-6">
						{{ Form::label('email', 'Email:') }}
						{{ Form::text('email', null, ['class' => 'form-control']) }}
					</div>

					<div class="col-md-12">
						{{ Form::label('comment', 'Comment:') }}
						{{ Form::textarea('comment', null, ['class' => 'form-control', 'rows' => '5']) }}
					
						{{ Form::submit('Send comment', ['class' => 'btn btn-success btn-block', 'style' => 'margin-top: 20px;']) }}
					</div>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
@stop