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
                <img class="img-fluid" src="{{asset('/storage/images/' . $profile->image)}}" alt="Profile image"></img>
                @else
                <img class="img-fluid" src="storage/images/avatar-placeholder.png" alt="Profile image"></img>
                @endif
            </div>
            <div class="profile-name">
                <h3>{{ $profile->name }}</h3>
                <small style="color: blue"><i class="fa fa-user"></i>&nbsp;&nbsp;followers {{ $user->followers()->get()->count() }}</small>
            </div>
            </a>
            <hr>
            @include('includes.profile-info')
            <hr>
            <div class="text-left">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editProfile">
                    Edit profile
                </button>
            </div>
        </div>
        
        <!-- post panel -->
        <div class="col-md-9 post-feed">
            
            <h2>Post feed</h2>
            <hr>
            @if ($errors->any())
                <p class="alert alert-danger"><?php echo 'Failed to edit post. Try again.' ?></p>
            @endif
            <!-- posts -->
            @foreach ($posts as $post)
                @include('includes.post')
            @endforeach
            <div class="mx-auto">
                {{ $posts->links() }}
            </div>
            <hr>
            <!-- create posts -->
            <div class="text-left" style="float: left">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#PostModal">
                    Create new post
                </button>
            </div>
            <div style="float:right;">
                <a href="{{ route('post.mine', ['id' => Auth::id()]) }}" class="btn btn-info">View your posts</a>
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
        @include('includes.modals.create-post')

        <!-- modal to edit/delete post -->
        @include('includes.modals.edit-post')

    </div>
</div>
@endsection
