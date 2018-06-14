@extends('layouts.app')

@section('content')
 <h1>Posts</h1>

    @foreach ($posts as $post)
        <h2><a href="{{  $post->url }}">{{ $post->title  }}</a></h2>
    @endforeach

    <div>{{ $posts->links() }}</div>
@endsection