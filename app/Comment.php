<?php

namespace App;

use Overtrue\LaravelLike\Traits\Likeable;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{

    use Likeable;

    protected $fillable = ['body', 'user_id', 'post_id'];

    public function post()
    {
        return $this->belongsTo('App\post');
    }

    public function user()
    {
        return $this->belongsTo('App\user');
    }
}
