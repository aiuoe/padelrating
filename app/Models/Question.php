<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    public $table = 'questions';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'title',
        'answer1',
        'openfield',
        'score1',
        'answer2',
        'score2',
        'answer3',
        'score3',
        'answer4',
        'score4',
        'nextanswer1question_id',
        'nextanswer2question_id',
        'nextanswer3question_id',
        'nextanswer4question_id',
        'order',
        'created_at',
        'updated_at',
    ];
}
