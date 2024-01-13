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

    /**
     * isGoalkeeper function
     *
     *  Check the player's position
     *
     * @return string
     */
    public function isGoalkeeper() {

        if ($this->goalkeeper === 1) {
            return 'Sim';
        }

        return 'Não';

    }

    /**
     * getSkillsLevels function
     *
     *  Check the player's hability levels
     *
     * @return string
     */
    public function getSkillsLevels() {
        switch ($this->skills_levels) {
            case 1:
                $skills_level = 'Bola mucha';
                break;

            case 2:
                $skills_level = 'Perna de pau';
                break;

            case 3:
                $skills_level = 'Ta na média';
                break;

            case 4:
                $skills_level = 'Jogador Caro';
                break;

            case 5:
                $skills_level = 'Craque';
                break;

            default:
                $skills_level = '--';
                break;
        }

        return $skills_level;
    }

}
