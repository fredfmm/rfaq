<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\Answer;
use \App\Category;
use \App\Tag;

class Question extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question_text', "category_id"
    ];

    public function answer()
    {
        return $this->hasOne(Answer::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
