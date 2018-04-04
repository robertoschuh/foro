@extends('layouts/app')

@section('content')

    <h1>{{  $post->title }}</h1>
    <div>{{ $post->content }}</div>
    <div>{{ $post->user->name }}</div>

    <div>Comentarios</div>

    {!! Form::open(['route' => ['comments.store', $post], 'method' => 'POST']) !!}

        {!! Field::textarea('comment') !!}

    <button type="submit">
        Publicar comentario
    </button>
    {!! Form::close() !!}
@endsection