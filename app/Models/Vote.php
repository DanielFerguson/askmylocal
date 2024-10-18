<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $table = 'votes';

    protected $fillable = [
        'voter_id',
        'voteable_id',
        'voteable_type',
        'direction',
    ];
}
