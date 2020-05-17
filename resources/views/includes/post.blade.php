<div class="card posted border-primary mx-auto">
    <div class="card-header text-center bg-primary text-light">
        {{ $post->title }}
        @if(auth::id() === $post->user()->first()->id)
            <button type="button" class="btn btn-primary"  style="float: right; padding: 0 1rem" data-myid="{{ $post->id }}" data-mytitle="{{ $post->title }}" data-mycontent="{{ $post->content }}" data-toggle="modal" data-target="#editPost" ><i class="fa fa-ellipsis-h"></i></button>
        @endif
    </div>
    <div class="card-body">
        <p class="card-text">{{ $post->content }}</p>
    </div>
    <div class="card-footer text-muted ">
        <small style="float: left">Posted by: <a href="{{ route('profile', ['id' => $post->user()->first()->id]) }}">{{ $post->user()->first()->name }}</a> at {{ $post->created_at }}</small>
        <small style="float: right">

        <!-- like button -->
        @if(!Auth::user()->hasLiked($post))
        <form action="{{ route('post.like', ['liked_id'=> $post->id , 'liker_id'=> Auth::id() ]) }}" method="post" style="float: left">
            @csrf
            <input type="submit" name="like" class="fa fa-thumbs-up btn-primary" value=" {{$post->likers()->count()}}">
        </form>&nbsp;&nbsp;
        @else
        <form action="{{ route('post.unlike', ['liked_id'=> $post->id , 'liker_id'=> Auth::id() ]) }}" method="post" style="float: left">
            @csrf
            <input type="submit" name="like" class="fa fa-thumbs-up btn-info" value=" {{$post->likers()->count()}}">
        </form>&nbsp;&nbsp;
        @endif
        
        <!-- link to comments -->
        <a href="{{ route('comments.show', ['id' => $post->id]) }}"  style="text-decoration: none;"><i class="fa fa-comment"></i>&nbsp;
        <span>{{$post->comments->count()}}</span></a></small>
    </div>
</div>