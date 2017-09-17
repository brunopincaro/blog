@extends('main')

@section('title', '- All categories')

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
					@foreach($categories as $category)
					<tr>
						<td>{{ $category->id }}</td>
						<td>{{ $category->name }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>

		<div class="col-md-3">
			<div class="well">
				{!! Form::open(['route' => 'categories.store', 'method' => 'POST']) !!} <?php /* check the method type for this route with artisan */ ?>
					
					<h2>New category</h2>

					{!! Form::label('name', 'Name:') !!}
					{!! Form::text('name', null, ['class' => 'form-control']) !!}

					{!! Form::submit('Create new category', ['class' => 'btn btn-primary btn-block', 'style' => 'margin-top: 20px;']) !!}

				{!! Form::close() !!}
			</div>
		</div>
	</div>

@stop