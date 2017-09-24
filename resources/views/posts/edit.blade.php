@extends('main')

@section('title', ' - edit blog post')

@section('stylesheets')
    {!! Html::style('css/select2.min.css') !!}
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=uq8y2r1sp169la0l8nlw9qcyevls79tzpsgwmgytjgcy3gl4"></script>
    <script>
        tinymce.init({
            selector:'textarea',
            plugins: "link code image imagetools",
            menubar: false
        });
    </script>
    <?php
        // because it loads asynchronosly we can load it on top
    ?>
@stop

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

            <?php
                /*
                    select('database_column', array('value="{{ $category->id }}"' => '{{ $category->name }}'), default value, array(<css...>) )

                    this  array('value="{{ $category->id }}"' => '{{ $category->name }}') should be created in the controller
                */
            ?>
            {{ Form::label('category_id', 'Category:') }}
            {{ Form::select('category_id', $categories, $post->category_id, ['class' => 'form-control'] ) }}
            <?php
                /*
                    $categories is the array in the form array('id' => 'name') : $cats[$category->id] = $category->name;

                    could use 'null' instead of ' $post->category_id' as the default value because of the model form binding will take over and change it to the default value
                */
            ?>

            {{ Form::label('tags', 'Tags:') }}
            {{ Form::select('tags[]', $tags, null, ['class' => 'form-control select2-multi', 'multiple' => "multiple"] ) }}

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

@section('scripts')
    {!! Html::script('js/select2.min.js') !!}

    <script>
        $('.select2-multi').select2();
    </script>
@stop