<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //

    protected $fillable = [
        'text','user_id','book_id'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }
    public function book() {
        return $this->belongsTo('App\Book');
    }
    public function commentRatings(){
        return $this->hasMany('App\CommentRating');
    }
}
