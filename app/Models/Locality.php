<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locality extends Model
{
    use HasFactory;

    protected $table = 'localities';

    public $timestamps = false;

    protected $fillable = [
        'state',
        'name',
    ];

    public static function findByStateAndName(string $state, string $name): ?Locality
    {
        return static::whereRaw('LOWER(REPLACE(state, " ", "-")) = ?', [strtolower(str_replace(' ', '-', $state))])
            ->whereRaw('LOWER(REPLACE(name, " ", "-")) = ?', [strtolower(str_replace(' ', '-', $name))])
            ->first();
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function answers()
    {
        return $this->hasManyThrough(Answer::class, Question::class);
    }
}
