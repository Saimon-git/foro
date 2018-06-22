<article>
    <h4>
        <a href="{{ $post->url }}">
            {{$post->title}}
        </a>
    </h4>
    <p>
        Publicado por <a href="#">{{ $post->user->name }}</a>
        {{ $post->created_at->diffForHumans() }}
        en <a href="{{ $post->category->url }}">
            {{ $post->category->name }}.
        </a>
        @if($post->pending)
        <span class="label label-warning">Pendiente</span>
        @else
        <span class="label label-success">Completado</span>
        @endif
        @if(Auth::check())
        <app-vote 
                module="posts"
                votable_id="{{$post->id}}"
                score="{{$post->score}}" 
                vote="{{$post->current_vote}}">
        </app-vote>
        @else
        @endif
    
    <hr>
</article>