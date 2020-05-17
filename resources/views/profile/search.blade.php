@extends('layouts.app')

@section('title', 'search results')

@section('content')


<div class="container">
    @if(isset($details))
        <h2>Profiles found:</h2><br>
        <div class="row">
        @foreach($details as $profile)
                <div class="col-md-3">
                    <a href="{{ route('profile', ['id'=> $profile->user_id]) }}" style="text-decoration: none; color: black;">
                        @if($profile->image)
                        <img class="img-fluid" src="{{asset('/storage/images/' . $profile->image)}}" alt="Profile image"></img>
                        @else
                        <img class="img-fluid" src="{{asset('/storage/images/avatar-placeholder.png')}}" alt="Profile image"></img>
                        @endif
                        <br>
                        <p class="text-center">{{$profile->name}}</p>
                    </a>
                </div>
        @endforeach
    @else
    <h2>No profiles found.</h2><br>
    <a href="{{ route('dashboard') }}" class="btn btn-info">Go back to dashboard</a>
    @endif
    </div>
</div>

@endsection