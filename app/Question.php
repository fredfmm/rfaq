<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\Answer;
use \App\Category;
use \App\Tag;

class Question extends Model
{
    public function answer()
    {
        return $this->hasOne(Answer::class);
    }

    public function category()
    {
        return $this->hasOne(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
