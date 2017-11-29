@extends('layouts.app')

@section('content')
<h1>{{$post->title}}</h1>

{!! $post->safe_html_content !!}

<p>{{$post->user->name}}</p>
@if (auth()->check())
	@if (!auth()->user()->isSubscribedTo($post))
		{!! Form::open(['route' => ['posts.subscribe', $post, 'method' => 'POST']]) !!}
			<button type="submit">Suscribirse al Post</button>
		{!! Form::close() !!}
	@else
		{!! Form::open(['route' => ['posts.unsubscribe', $post], 'method' => 'DELETE']) !!}
	        <button type="submit" class="btn btn-default">Desuscribirse del Post</button>
		{!! Form::close() !!}
	@endif
@endif

<h4>Comentarios</h4>

	{!! Form::open(['route' => ['comments.store', $post], 'method' => 'POST',]) !!}
	
		{!! Field::textarea('comment') !!}

		<div class="form-group">
		    <div class="col-md-6 col-md-offset-4">
		        <button type="submit" class="btn btn-primary">
		            Publicar comentario
		        </button>
		    </div>
		</div>
	{!! Form::close() !!}

	@foreach ($comments as $comment)
	<article class="{{$comment->answer ? 'answer' : ''}}">
		<h5>{{ $comment->user->name }}</h5>
		<p>
		 {{$comment->comment}}
		</p>
		
		@if(Gate::allows('accept',$comment) && !$comment->answer)
		{!! Form::open(['route' => ['comments.accept',$comment],  'method' => 'POST',]) !!}
			<button type="submit">Aceptar Respuesta</button>
		{!! Form::close() !!}
		@endif
	</article>

	@endforeach
	{{ $comments->render() }}

@endsection
