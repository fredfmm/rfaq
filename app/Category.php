<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\Question;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_name'
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
