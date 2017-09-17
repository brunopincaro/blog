@extends('main')

@section('title', '- view post')

@section('content') 
	<div class="row">
		<div class="col-md-8">
			<h1>{{ $post->title }}</h1>

			<p class="lead">
				{{ $post->body }}
			</p>
		</div>

		<div class="col-md-4">
			<div class="well">
				<dl class="dl-horizontal">
					<dt>URL Slug:</dt>
					<dd><a href="{{ route('blog.single', $post->slug) }}">{{ $post->slug }}</a></dd>
				</dl>

				<dl class="dl-horizontal">
					<dt>Category:</dt>
					<dd>{{ $post->category->name }}</dd>
				</dl>

				<dl class="dl-horizontal">
					<dt>Created at:</dt>
					<dd>{{ date( 'Y M d, H:i', strtotime($post->created_at) ) }}</dd>
				</dl>

				<dl class="dl-horizontal">
					<dt>Last updated:</dt>
					<dd>{{ date( 'Y M d, H:i', strtotime($post->updated_at) ) }}</dd>
				</dl>
				
				<hr>

				<div class="row">
					<div class="col-sm-6">
						<?php
							// HTML::linkRoute('route', 'anchor value', array() = mandatory, array() )
							// allows us to pass a named route and generate a full anchor title like <a href="#" class="btn btn-primary btn-block">Edit</a>
						?>
						{!! Html::linkRoute('posts.edit', 'Edit', array($post->id), array('class' => 'btn btn-primary btn-block') ) !!}
					</div>
					<div class="col-sm-6">
						{!! Form::open( array( 'route' => array('posts.destroy', $post->id), 'method' => 'DELETE') ) !!}
							{!! Form::submit('Delete', array('class' => 'btn btn-danger btn-block')) !!}
						{!! Form::close() !!}
					</div>
                    <div class="col-md-12">
                        {{ Html::linkRoute('posts.index', '<< See all posts', array(), array('class' => 'btn btn-default btn-block btn-h1-spacing')) }}
                    </div>
				</div>				
			</div>
		</div>
	</div>
@stop