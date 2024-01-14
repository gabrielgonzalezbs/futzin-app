<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Matches extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'game_day',
        'game_hour',
        'location',
        'players_per_team',
        'status',
        'token',
        'user_id',
    ];

     /**
     * Get the matchs for the players.
     */
    public function matchesPlayers(): HasMany
    {
        return $this->hasMany(PlayersMatches::class, 'matche_id', 'id');
    }

    public function getStatus() {

        switch ($this->status) {
            case 'A':
                $status = 'Ativa';
                break;

            case 'R':
                $status = 'Sorteio realizado';
                break;

            case 'E':
                $status = 'Jogo encerrado';
                break;

            default:
                $status = '--';
                break;
        }

        return $status;

    }

}
