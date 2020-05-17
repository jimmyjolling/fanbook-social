<?php

namespace App;

use Overtrue\LaravelLike\Traits\Likeable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Likeable;
    
    protected $fillable = [
        'title', 'content'
    ];
    
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function comments() {
        return $this->hasMany('App\comment');
    }
}
