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
    ];

    public static function findByStateAndName(string $state, string $name): ?Locality
    {
        return static::whereRaw('LOWER(state) = ?', [strtolower($state)])
            ->whereRaw('LOWER(name) = ?', [strtolower($name)])
            ->first();
    }
}
