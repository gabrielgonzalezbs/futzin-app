<?php

namespace App\Repositories;

use App\Http\Requests\PlayersRequest;
use App\Models\Players;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PlayersRepository
{
    public function create(PlayersRequest $request): Players
    {
        return DB::transaction(function () use ($request) {
            $user = Auth::user();

            $player = Players::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'skills_levels' => $request->input('skills_levels'),
                'goalkeeper' => $request->input('goalkeeper'),
                'user_id' => $user->id
            ]);

            return $player;
        });
    }

    function update(PlayersRequest $request, Players $player): Players {

        return DB::transaction(function () use ($request, $player) {
            $player->fill([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'skills_levels' => $request->input('skills_levels'),
                'goalkeeper' => $request->input('goalkeeper')
            ]);

            $player->save();

            return $player;
        });

    }

    public function delete(Players $player) : Bool {

        return DB::transaction(function () use ($player) {
            $affected = $player->delete();

            return $affected;
        });

    }

}
