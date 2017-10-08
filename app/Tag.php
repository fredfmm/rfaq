<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\Question;

class Tag extends Model
{
    public function questions()
    {
        return $this->belongsToMany(Question::class);
    }
}
