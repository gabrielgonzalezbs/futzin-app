<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Players extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'players';

    protected $fillable = [
        'name',
        'email',
        'skills_levels',
        'goalkeeper',
        'user_id'
    ];

}
