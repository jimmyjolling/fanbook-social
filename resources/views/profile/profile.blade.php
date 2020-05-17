@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="container">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="row profile">
        <!-- profile picture -->
        <div class="col-md-4">
                @if($profile->image)
                <img class="img-fluid" src="{{asset('/storage/images/' . $profile->image)}}" alt="Profile image"></img>
                @else
                <img class="img-fluid" src="{{asset('/storage/images/avatar-placeholder.png') }}" alt="Profile image"></img>
                @endif
            <div class="profile-name">
                <h3 class="text-center">{{ $profile->name }}</h3>
            </div>
        </div>
        <div class="col-md-2"></div>
        <!-- profile info -->
        <div class="col-md-6">
            <h1>Profile info</h1>
            <small style="color: blue"><i class="fa fa-user"></i>&nbsp;&nbsp;followers {{ $user->followers()->get()->count() }}</small>
            <hr>
            @include('includes.profile-info')
            <hr>
            @if(Auth::id() == $profile->user_id)
            <div class="text-left">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Edit profile
                </button>
            </div>
            @else
                @if(Auth::user()->isFollowing($user))
                <div class="text-left">
                    <form action="{{ route('profile.unfollow', ['followed_id'=> $profile->user_id , 'follower_id'=> Auth::id() ]) }}" method="post">
                        @csrf
                        <button type="submit" name="follow" class="btn btn-primary"><i class="fa fa-user-plus"></i>
                            Unfollow profile
                        </button>
                    </form>
                </div>
                @else
                <div class="text-left">
                    <form action="{{ route('profile.follow', ['followed_id'=> $profile->user_id , 'follower_id'=> Auth::id() ]) }}" method="post">
                        @csrf
                        <button type="submit" name="follow" class="btn btn-primary"><i class="fa fa-user-plus"></i>
                            Follow profile
                        </button>
                    </form>
                </div>
                @endif
            @endif    
            

            <!-- modal to edit profile-->
         <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    </div>
</div>

@endsection('content')