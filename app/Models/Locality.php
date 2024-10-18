<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Locality extends Model
{
    protected $table = 'localities';

    protected $timestamps = false;

    protected $fillable = [
        'state',
        'name',
    ];
}
