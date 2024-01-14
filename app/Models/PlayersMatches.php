<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlayersMatches extends Model
{
    use HasFactory;

    protected $fillable = [
        'player_id',
        'matche_id',
        'confirmed',
        'confirmation_date',
        'team_name',
    ];

    /**
     * Get the players that owns the matche.
     */
    public function players(): BelongsTo
    {
        return $this->belongsTo(Players::class, 'player_id');
    }

        /**
     * Get the players that owns the matche.
     */
    public function matches(): BelongsTo
    {
        return $this->belongsTo(Matches::class, 'matche_id');
    }
}
