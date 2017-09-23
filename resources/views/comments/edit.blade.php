@extends('main')

@section('title', ' - edit comment')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3>Edit comment</h3>

            {{ Form::model($comment, array('route' => array('comments.update', $comment->id ),'method' => 'PUT')) }}
                {{ Form::label('name', 'Name:') }}
                {{ Form::text('name', null, ['class' => 'form-control', 'disabled' => 'disabled']) }}
                
                {{ Form::label('email', 'Email:') }}
                {{ Form::text('email', null, ['class' => 'form-control', 'disabled' => 'disabled'] ) }}
                
                {{ Form::label('comment', 'Comment:') }}
                {{ Form::textarea('comment', null, ['class' => 'form-control', 'rows' => '5']) }}
                
                {{ Form::submit('Update comment', ['class' => 'btn btn-success btn-block', 'style' => 'margin-top:20px;']) }}
                
            {{ Form::close() }}
        </div>
    </div>
@stop