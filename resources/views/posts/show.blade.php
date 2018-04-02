@extends('layouts/app')

@section('content')

    <h1>{{  $post->title }}</h1>
    <div>{{ $post->content }}</div>
    <div>{{ $post->user->name }}</div>
@endsection