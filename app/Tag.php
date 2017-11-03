<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\Question;

class Tag extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "tag_name"
    ];

    public function questions()
    {
        return $this->belongsToMany(Question::class);
    }
}
