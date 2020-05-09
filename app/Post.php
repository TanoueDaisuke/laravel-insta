<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // リレーション定義
    public function likes() {
        return $this->hasMany('App\Like');
    }

    public function comments() {
        return $this->hasMany('App\Comment');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
