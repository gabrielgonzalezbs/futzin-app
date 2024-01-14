<?php

namespace App\Repositories;

use App\Http\Requests\MatchesRequest;
use App\Models\Matches;
use App\Models\PlayersMatches;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
                'token' => 'token_0',
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

}
