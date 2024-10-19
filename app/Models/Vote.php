<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $table = 'votes';

    protected $fillable = [
        'voter_id',
        'voteable_id',
        'voteable_type',
        'direction',
    ];

    protected $casts = [
        'voteable_id' => 'integer',
    ];

    public function voteable()
    {
        return $this->morphTo();
    }

    public function voter()
    {
        return $this->belongsTo(User::class, 'voter_id');
    }
}
