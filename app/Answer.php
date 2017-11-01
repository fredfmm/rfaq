<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\Question;
class Answer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "answer_text", "question_id"
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
