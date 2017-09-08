@extends('main')

@section('title','')

@section('content')
            <div class="row">
                <div class="col-md-12">
                    <div class="jumbotron">
                        <h1>brunopincaro</h1>
                        <p class="lead">Welcome to my website.Thank you for visiting and please don't forget to read my popular posts.</p>
                        <p><a class="btn btn-primary btn-lg" href="#" role="button">Popular posts</a></p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">

                    @foreach($posts as $post)

                    <div class="post">
                        <h3>{{ $post->title }}</h3>

                        <small>{{ date_format($post->updated_at, 'Y-m-d') }}</small>

                        <p>
                            {{ substr($post->body, 0, 300) }} {{ strlen($post->body) > 300 ? '...' : '' }}
                        </p>

                        <a href="{{ url('blog/'.$post->slug) }}" class="btn btn-primary">Read more</a>
                    </div>

                    <hr>

                    @endforeach

                </div>

                <div class="col-md-3 col-md-offset-1">
                    <h2>Sidebar</h2>
                </div>
            </div>
@stop