<?php

namespace App\Repositories;

use App\Http\Requests\MatchesRequest;
use App\Models\Matches;
use App\Models\PlayersMatches;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class MatchesRepository
{
    public function create(MatchesRequest $request): Matches
    {
        return DB::transaction(function () use ($request) {
            $user = Auth::user();

            $match = Matches::create([
                'description' => $request->input('description'),
                'game_day' => $request->input('game_day'),
                'game_hour' => $request->input('game_hour'),
                'location' => $request->input('location'),
                'players_per_team' => $request->input('players_per_team'),
                'status' => 'A',
                'token' => Uuid::uuid4(),
                'user_id' => $user->id
            ]);

            if (!empty($request->input('playears'))) {
                $players = [];
                foreach ($request->input('playears') as $key => $player) {

                    $confirmed = !empty($player['confirmed']) ? true : false;

                    $confirmation_date = null;
                    if ($confirmed)
                        $confirmation_date = now();

                    $players[] = [
                        "matche_id" => $match->id,
                        "player_id" => $player['id'],
                        "confirmed" => $confirmed,
                        "confirmation_date" => $confirmation_date,
                        "created_at" => now(),
                    ];
                }

                PlayersMatches::insert($players);

            }

            return $match;
        });
    }

    function update(MatchesRequest $request, Matches $match): Matches {

        return DB::transaction(function () use ($request, $match) {
            $match->fill([
                'description' => $request->input('description'),
                'game_day' => $request->input('game_day'),
                'game_hour' => $request->input('game_hour'),
                'location' => $request->input('location'),
                'players_per_team' => $request->input('players_per_team'),
            ]);

            $match->save();

            if (!empty($request->matchesPlayers)) {
                $update = [];
                $insert = [];
                foreach ($request->matchesPlayers as $key => $value) {

                    $confirmed = !empty($value['confirmed']) ? true : false;

                    $confirmation_date = null;
                    if ($confirmed)
                        $confirmation_date = now();

                    if (!empty($value['id'])) {
                        $update[$value['id']] = [
                            "id"        => $value['id'],
                            "confirmed" => $confirmed,
                            "confirmation_date" => $confirmation_date,
                            "updated_at" => now(),
                        ];
                    } else {
                        $insert[] = [
                            "matche_id" => $match->id,
                            "player_id" => $value['player_id'],
                            "confirmed" => $confirmed,
                            "confirmation_date" => $confirmation_date,
                            "updated_at" => now(),
                        ];
                    }



                }

                if (!empty($update)) {
                    $match->matchesPlayers->each(function (PlayersMatches $playersMatches) use($update) {

                        $values = $update[$playersMatches->id];

                        $playersMatches->confirmed = $values['confirmed'];
                        $playersMatches->confirmation_date = $values['confirmation_date'];
                        $playersMatches->updated_at = $values['updated_at'];
                    });

                    $match->push();
                }

                if (!empty($insert))
                    PlayersMatches::insert($insert);

            }

            return $match;
        });

    }

    public function delete(Matches $match) : Bool {

        return DB::transaction(function () use ($match) {
            $affected = $match->delete();

            return $affected;
        });

    }

    public function markeSort(Matches $match, object $players) : Bool {
        $groupSize = $match->players_per_team;
        $numGroups = ceil($players->count() / $groupSize);
        $groups = array();

        for ($i = 0; $i < $numGroups; $i++) {
            $groups[$i] = array(
                "hasGoalkeeper" => false,
                "players" => [],
            );
        }

        // assign players to groups
        $index = 0;
        while ($index < $players->count()) {

            $player = $players[$index];

            $groups = $this->sortPlayers($player, $groups, $groupSize, $numGroups);

            $index++;
        }


        $match->matchesPlayers->each(function (PlayersMatches $playersMatches) use ($groups) {

            foreach ($groups as $key => $group) {

                foreach ($group['players'] as $players) {

                    if ($playersMatches->player_id == $players->player_id) {
                        $playersMatches->team_name = "$key";
                    }

                }

            }

        });

        $match->status = 'R';

        return $match->push();
    }

    /**
     * sortPlayers function
     *
     * Classify players by browsing existing
     * groups and checking requirements
     *
     * @param object $player
     * @param array $groups
     * @param string $groupSize
     * @param string $numGroups
     * @return array
     */
    private function sortPlayers($player, $groups, $groupSize, $numGroups)
    {

        for ($i=0; $i < $numGroups; $i++) {
            if ($player->goalkeeper === 1 && $groups[$i]["hasGoalkeeper"]) {

                if ($i === count($groups) - 1) {
                    $groups['reservas']["players"][] = $player;
                    break;
                }

                continue;
            }

            if (count($groups[$i]['players']) >= $groupSize) {
                continue;
            }

            if ($player->goalkeeper === 1 && !$groups[$i]["hasGoalkeeper"]) {
                $groups[$i]["hasGoalkeeper"] = $player->goalkeeper == 1 ? true : false;
            }

            $groups[$i]["players"][] = $player;
            break;
        }

        return $groups;
    }

}
