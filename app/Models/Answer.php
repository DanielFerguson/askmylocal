<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'answers';

    protected $fillable = [
        'question_id',
        'answered_by_id',
        'value',
    ];
}
