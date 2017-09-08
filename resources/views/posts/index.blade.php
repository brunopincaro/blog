@extends('main')

@section('title', '- your posts')

@section('content')

	<div class="row">
		<div class="col-md-10">
			<h1>All your posts</h1>

		</div>

		<div class="col-md-2">
			{!! Html::linkRoute('posts.create', 'Create new post', array(), array('class' => 'btn btn-lg btn-block btn-primary btn-h1-spacing')) !!}
		</div>

		<div class="col-md-12">
			<hr>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<table class="table">
				<thead>
					<th>#</th>
					<th>Title</th>
					<th>Content</th>
					<th>Created at</th>
					<th></th>
				</thead>
				
				<tbody>
					@foreach ($posts->all() as $post)
						<tr>
							<th>{{ $post->id }}</th>
							<td>{{ $post->title }}</td>
							<td>{{ substr($post->body, 0, 100) }} {{ ( strlen($post->body) > 160 ) ? "..." : "" }}</td>
							<td>{{ date( 'Y M d, H:i', strtotime($post->created_at)) }}</td>
							<td>
								{!! Html::linkRoute('posts.show', 'View', array($post->id), array('class' => 'btn btn-sm btn-default')) !!}
								{!! Html::linkRoute('posts.edit', 'Edit', array($post->id), array('class' => 'btn btn-sm btn-default')) !!}
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>

			<div class="text-center">
				{!! $posts->links() !!}
			</div>
		</div>
	</div>
@stop