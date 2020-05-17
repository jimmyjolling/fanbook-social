@extends('layouts.app')

@section('title', 'comments')

@section('content')

    <div class="container">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
        <h2>Posted by {{ $post->user()->first()->name }}</h2>
        <hr>
        @include('includes.post')
        <div class="row">
            @foreach( $comments as $comment )
                @if($comment->user()->first()->id == auth::id())
                    <div class="col-md-12">
                        <a class="comment-link" href="" data-mycommentid="{{ $comment->id }}" data-mycommentcontent="{{ $comment->body }}" data-toggle="modal" data-target="#editComment">
                            <div class="card">
                                <div class="card-header">
                                    <h4 style="float: left">{{ $comment->user()->first()->name }}</h4>
                                    <small style="float: right">{{ $comment->created_at }}</small>
                                </div>
                                <div class="card-body">
                                    <p>{{ $comment->body }}</p>
                                </div>
                            </div>
                        </a><br>
                    </div>
                @else
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 style="float: left">{{ $comment->user()->first()->name }}</h4>
                                <small style="float: right">{{ $comment->created_at }}</small>
                            </div>
                            <div class="card-body">
                                <p>{{ $comment->body }}</p>
                            </div>
                        </div>
                        <br>
                    </div>
                @endif
            @endforeach
        </div>
        
        <hr>
        <h4>Add a comment</h4>
        @if ($errors->has('body'))
            <p class="alert alert-danger"><?php echo 'Failed to comment. Please fill in a comment.' ?></p>
         @endif
        <form action="{{ route('comments.store') }}" method="post">
        @csrf
            <div class="form-group">
                <label for="comment">Comment on this post:</label>
                <textarea class="form-control" name="body" rows="3"></textarea>
                <input type="hidden" name="post_id" value="{{ $post->id }}">
            </div>
            <div class="form-group">
                <input  type="submit" class="btn btn-primary" value="Add comment">
                <a href="{{ route('dashboard') }}" class="btn btn-info">Go back to dashboard</a>
            </div>
        </form>

    </div>

    <!-- modal to edit comment -->
    <div class="modal fade" id="editComment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit your profile information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('comments.edit') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="comment">Comment on this post:</label>
                            <textarea class="form-control" id="comment-content-edit" name="body" rows="3"></textarea>
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                        </div>
                        <input type="hidden" id="comment-id" name="comment_id">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Save changes"></button>
                        </form>
                        <form action="{{ route('comments.delete') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="comment-id-delete" name="comment-id-delete">
                            <input type="submit" class="btn btn-danger" value="Delete"></button>
                        </form>
                    </div>
                </div>
            </div>
    </div>

@endsection