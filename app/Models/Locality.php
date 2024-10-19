<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Locality extends Model
{
    protected $table = 'localities';

    public $timestamps = false;

    protected $fillable = [
        'state',
        'name',
        'profile_photo_url',
        'background_photo_url',
    ];

    public function councillors()
    {
        return $this->hasMany(User::class)->where('is_councillor', true);
    }

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
