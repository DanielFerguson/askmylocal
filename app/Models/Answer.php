<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $table = 'answers';

    protected $fillable = [
        'question_id',
        'answered_by_id',
        'value',
    ];

    // protected $with = [
    //     'votes',
    // ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function answeredBy()
    {
        return $this->belongsTo(User::class, 'answered_by_id');
    }
}
