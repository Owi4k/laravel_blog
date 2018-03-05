<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = [
    	'content', 'author'
    ];

    protected $table = 'feedbacks';

    public function commentable()
    {
		return $this->morphTo();
    }
}
