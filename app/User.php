<?php

namespace App;

use Overtrue\LaravelLike\Traits\Liker;
use Overtrue\LaravelFollow\Followable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    use Followable;
    use Liker;

    public function identities() {
        return $this->hasMany('App\SocialIdentity');
    }

    public function profile() {
        return $this->hasOne('App\Profile');
    }

    public function post() {
        return $this->hasMany('App\Post');
    }

    public function comments() {
        return $this->hasMany('App\comment');
    }
}
