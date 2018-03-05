<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
    	'name', 'content', 'image'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_posts');
    }

    public function feedbacks()
    {
        return $this->morphMany('App\Feedback', 'commentable');
    }
}
