<?php

namespace App\Http\Controllers;

use App\User;
use App\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show($id) {
        $profile = Profile::where('user_id', $id)->first();
        $user = User::where('id', $id)->first();

        return view('profile.profile', compact('profile', 'user'));
    }

    public function update(Request $request, $id) {
        $profile = Profile::where('user_id', $id);

        $profile->update([
            'work'=>$request->input('work'),
            'location'=>$request->input('location'),
            'heritage'=>$request->input('heritage')
        ]);

        if($request->input('relation_status')) {
            $profile->update(['relation_status'=>true]);
            if ($request->input('relation')) {
                $profile->update(['relation'=>$request->input('relation')]);
            }
        } else {
            $profile->update(['relation_status'=>false]);
        }

        if($request->file('image'))
        {
            $filename = $request->image->getClientOriginalName();
            $request->image->storeAs('images', $filename, 'public');
            
            $profile->update(['image'=>$filename]);
        }
        
            return redirect()->back(); 
    }

    public function followProfile($followed, $follower) 
    {
        $followed_profile = User::find($followed);
        $profile_follower = User::find($follower);
        $profile_follower->follow($followed_profile);

        return redirect()->back()->with('status', "You just followed $followed_profile->name!"); 
    }

    public function unfollowProfile($followed, $follower) 
    {
        $followed_profile = User::find($followed);
        $profile_follower = User::find($follower);
        $profile_follower->unfollow($followed_profile);

        return redirect()->back()->with('status', "You just followed $followed_profile->name!"); 
    }

    public function search(Request $request) {
        $search = $request->input('search');
        $profile = Profile::where('name','LIKE','%'.$search.'%')->get();
        if(count($profile) > 0) {
            return view("profile.search")->withDetails($profile)->withQuery($search);
        } elseif ($request->url() == 'http://localhost/php-3/fanbook-social/public/profile/search') {
            return view("profile.search")->with('search', 'The profile you\'re looking for does not exist.');
        } else {
            return redirect()->back()->with('search', 'The profile you\'re looking for does not exist.');
        }
    }
}
