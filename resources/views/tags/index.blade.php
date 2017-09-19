@extends('main')

@section('title', '- All tags')

@section('content')

	<div class="row">
		<div class="col-md-8">
			<h1>Categories</h1>

			<table class="table">
				<thead>
					<tr>
						<th>#ID</th>
						<th>Name</th>
					</tr>
				</thead>
				<tbody>
					@foreach($tags as $tag)
					<tr>
						<td>{{ $tag->id }}</td>
						<td>{{ $tag->name }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>

		<div class="col-md-3">
			<div class="well">
				{!! Form::open(['route' => 'tags.store', 'method' => 'POST']) !!} <?php /* check the method type for this route with artisan */ ?>
					
					<h2>New tag</h2>

					{!! Form::label('name', 'Name:') !!}
					{!! Form::text('name', null, ['class' => 'form-control']) !!}

					{!! Form::submit('Create new tag', ['class' => 'btn btn-primary btn-block', 'style' => 'margin-top: 20px;']) !!}

				{!! Form::close() !!}
			</div>
		</div>
	</div>

@stop