<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'questions';

    protected $fillable = [
        'asked_by_id',
        'locality_id',
        'value',
    ];

    protected $with = [
        'answers',
        'votes',
    ];

    public function locality()
    {
        return $this->belongsTo(Locality::class);
    }

    public function votes()
    {
        return $this->morphMany(Vote::class, 'voteable');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function askedBy()
    {
        return $this->belongsTo(User::class, 'asked_by_id');
    }
}
