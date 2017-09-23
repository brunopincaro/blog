@extends('main')

@section('title', ' - Delete comment')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3>DELTE THIS COMMENT</h3>

            <p>
                <strong>Name:</strong> {{ $comment->name }} <br>
                <strong>Email:</strong> {{ $comment->email }} <br>
                <strong>Comment:</strong> {{ $comment->comment }} <br>
            </p>

            {{ Form::open(['route' => ['comments.destroy', $comment->id], 'method' => 'DELETE']) }}
                {{ Form::submit('DELETE COMMENT', ['class' => 'btn btn-danger btn-block']) }}
            {{ Form::close() }}
        </div>
    </div>
@stop