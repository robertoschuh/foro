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

    @foreach($post->latestComments as $comment)

        <article class="{{ $comment->answer ? 'answer' : '' }}">
            <h4 class="author">{{ $comment->user->name }}</h4>
            <p> {{ $comment->comment }}</p>

            @if(Gate::allows('accept', $comment) && !$comment->answer)
                {!! Form::open(['route' => ['comments.accept', $comment], 'method' => 'POST']) !!}
                    <button>Submit answer</button>
                {!! Form::close() !!}
            @endif
        </article>
    @endforeach
@endsection