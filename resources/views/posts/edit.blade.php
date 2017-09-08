@extends('main')

@section('title', ' - edit blog post')

@section('content')
    <div class="row">

        {!! Form::model($post, array('route' => array('posts.update',$post->id ),'method' => 'PUT')) !!}
        <?php
            // $post is the object model that contains the data and that we want the form to bind with
            // route points to the view where to go after click submit
            // the route 'posts.update' also needs the post id, which we have to pass

            // in the php artisan route:list, the route 'posts.update' is expecting a method 'PUT|PATCH'
            // if no method is defined, it will try the 'POST' method by default
                ?>

        <div class="col-md-8">
            <h1>
                {{ Form::label('title', 'Title:') }}
                {{ Form::text('title', null, array('class' => 'form-control input-lg')) }}
            </h1>

            <p class="lead">
                {{ Form::label('slug', 'Slug:') }}
                {{ Form::text('slug', null, array('class' => 'form-control')) }}
            </p>

            <p class="lead">
                {{ Form::label('body', 'Body:') }}
                {{ Form::textarea('body', null, array('class' => 'form-control')) }}
            </p>
        </div>

        <div class="col-md-4">
            <div class="well">
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
                        {!! Html::linkRoute('posts.show', 'Cancel', array($post->id), array('class' => 'btn btn-danger btn-block') ) !!}
                        <?php
                            // linking to posts.show works as a cancel because it will return to the blog post
                            ?>
                    </div>
                    <div class="col-sm-6">
                        {{ Form::submit('Save changes', array('class' => 'btn btn-block btn-success')) }}
                        <?php
                            // Form::submit() will post the form to the view defined when opening the form, in this case the 'posts.update', so we don't need to pass the first parameter, only the button value, 'Save changes'
                            ?>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@stop