@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <div class="row">

        <!-- Profile info -->
        <div class="col-md-3 profile-aside">
            <a href="{{ route('profile', ['id' => $profile->user_id]) }}" style="text-decoration: none; color: black">
            <div class="profile-img mx-auto">
                @if($profile->image)
                <img class="img-fluid" src="{{asset('/storage/images/' . $profile->image) }}" alt="Profile image"></img>
                @else
                <img class="img-fluid" src="{{asset('/storage/images/avatar-placeholder.png') }}" alt="Profile image"></img>
                @endif
            </div>
            <div class="profile-name">
                <h3>{{ $profile->name }}</h3>
            </div>
            </a>
            <hr>
            <div>
                <p class="text-left"><i class="fa fa-briefcase"></i>&nbsp;&nbsp;&nbsp;&nbsp;Works at {{ $profile->work }}</p>
                <p class="text-left"><i class="fa fa-home"></i>&nbsp;&nbsp;&nbsp;&nbsp;Lives in {{ $profile->location }}</p>
                <p class="text-left"><i class="fa fa-map-marker"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Grew up in {{ $profile->heritage }}</p>
                @if ($profile->relation_status && $profile->relation)
                <p class="text-left"><i class="fa fa-heart"></i>&nbsp;&nbsp;&nbsp;&nbsp;In relation with {{ $profile->relation }}</p>
                @elseif ($profile->relation_status)
                <p class="text-left"><i class="fa fa-heart"></i>&nbsp;&nbsp;&nbsp;&nbsp;In relationship</p>
                @else
                <p class="text-left"><i class="fa fa-heart"></i>&nbsp;&nbsp;&nbsp;&nbsp;No relationship</p>
                @endif
            </div>
            <hr>
            <div class="text-left">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editProfile">
                    Edit profile
                </button>
            </div>
        </div>
        

        <!-- post panel -->
        <div class="col-md-9 post-feed">
            
            <h2>Your post feed</h2>
            <hr>
            @if ($errors->has('title-edit'))
                <p class="alert alert-danger"><?php echo 'Please fill in a title.' ?></p>
            @endif
            @if ($errors->has('content-edit'))
                <p class="alert alert-danger"><?php echo 'Please fill in the content.' ?></p>
            @endif
            <!-- posts -->
            @foreach ($posts as $post)
            <div class="card posted border-primary mx-auto">
                <div class="card-header text-center bg-primary text-light">
                    {{ $post->title }}
                    @if($id === $post->user()->first()->id)
                        <button type="button" class="btn btn-primary"  style="float: right; padding: 0 1rem" data-myid="{{ $post->id }}" data-mytitle="{{ $post->title }}" data-mycontent="{{ $post->content }}" data-toggle="modal" data-target="#editPost" ><i class="fa fa-ellipsis-h"></i></button>
                    @endif
                </div>
                <div class="card-body">
                    <p class="card-text">{{ $post->content }}</p>
                </div>
                <div class="card-footer text-muted ">
                    <small style="float: left">Posted by: {{ $post->user()->first()->name }} at {{ $post->created_at }}</small>
                    <small style="float: right"><a href="{{ route('comments.show', ['id' => $post->id]) }}" style="text-decoration: none;"><i class="fa fa-comment"></i>&nbsp;&nbsp;<span>{{$post->comments->count()}}</span></a></small>
                </div>
            </div>
            @endforeach
            <hr>
            <!-- create posts -->
            <div class="text-left" style="float: left">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#PostModal">
                    Create new post
                </button>
            </div>
            <div style="float:right;">
                <a href="{{ route('dashboard') }}" class="btn btn-info">Go back to post feed</a>
            </div>
        </div>

        <!-- modal to edit profile -->
        <div class="modal fade" id="editProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit your profile information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('profile.update', ['id' => $profile->user_id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="Work">Where do you work?</label>
                                <input class="form-control" type="text" name="work" value="{{ $profile->work }}">
                            </div>
                            <div class="form-group">
                                <label for="location">Where do you live?</label>
                                <input class="form-control" type="text" name="location" value="{{ $profile->location }}">
                            </div>
                            <div class="form-group">
                                <label for="heritage">Where did you grew up?</label>
                                <input class="form-control" type="text" name="heritage" value="{{ $profile->heritage }}">
                            </div>
                            <div class="form-group">
                                <label for="location">Upload a profile picture</label>
                                <input type="file" name="image">
                            </div>
                            <div class="form-group">
                                <label for="relation_status">Are you in a relationship?&nbsp;&nbsp;</label>
                                <input type="checkbox" value="1" name="relation_status" id="relation_status">
                                
                                <input class="form-control" type="text" name="relation" id="relation" placeholder="With who are you in a relationship?">
                            </div>
                        
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" value="Save changes"></button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- modal to post -->
        <div class="modal fade" id="PostModal" tabindex="-1" role="dialog" aria-labelledby="PostModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="PostModalLabel">Create a new post</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('post.create') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input class="form-control" type="text" name="title">
                                @if ($errors->has('title'))
                                    <small class="error">{{ $errors->first('title') }}</small>
                                @endif
                            </div>
                            <div class="form-group shadow-textarea">
                                <label for="content">Write your post</label>
                                <textarea class="form-control z-depth-1" name="content" id="content" rows="3" placeholder="Write something here...">{{ old('content') }}</textarea>
                                @if ($errors->has('content'))
                                    <small class="error">{{ $errors->first('content') }}</small>
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-primary" value="Post"></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- modal to edit/delete post -->
        <div class="modal fade" id="editPost" tabindex="-1" role="dialog" aria-labelledby="PostModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="PostModalLabel">Edit post</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('post.edit') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input class="form-control" type="text" id="title-edit" name="title-edit" value="{{ old('title-edit') }}">
                                @if ($errors->has('title-edit'))
                                    <small class="error"><?php echo 'This field is required.' ?></small>
                                @endif
                            </div>
                            <div class="form-group shadow-textarea">
                                <label for="content">Write your post</label>
                                <textarea class="form-control z-depth-1" name="content-edit" id="content-edit" rows="3" placeholder="Write something here...">{{ old('content-edit') }}</textarea>
                                @if ($errors->has('content-edit'))
                                    <small class="error"><?php echo 'This field is required.' ?></small>
                                @endif
                            </div>
                            <input type="hidden" id="post-id" name="post_id">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-primary" value="Edit"></button>
                                </form>
                                <form action="{{ route('post.delete') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" id="post-id-delete" name="post-id-delete">
                                    <input type="submit" class="btn btn-danger" value="Delete"></button>
                                </form>
                            </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection