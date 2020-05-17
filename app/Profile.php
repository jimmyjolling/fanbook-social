<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelFollow\Followable;

class Profile extends Model
{

    protected $fillable = [
        'user_id', 'name', 'work', 'location', 'heritage', 'relation', 'relation_status', 'profile_picture'
    ];

    public function user() {
        return $this->hasOne('app\User');
    }

    
}
