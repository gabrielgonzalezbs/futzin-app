<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlayersRequest;
use App\Models\Players;
use App\Repositories\PlayersRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlayersController extends Controller
{

    /**
     * Using the new feature 'property promotion' to inject the repository into the controller
     *
     * @param PlayersRepository $playersRepository
     */
    public function __construct(
        private PlayersRepository $playersRepository
    )
    {

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $players = Players::all();

        return view('players.index', ["players" => $players]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('players.forms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlayersRequest $request)
    {

        $player = $this->playersRepository->create($request);

        return redirect()->route('players.index')
            ->with('message.success', "Jogador '{$player->name}' cadastrado com sucesso!");

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Players $player)
    {

        return view('players.forms.update', ["player" => $player]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PlayersRequest $request, Players $player)
    {

        $player = $this->playersRepository->update($request, $player);

        return redirect()->route('players.index')
            ->with('message.success', "Jogador '{$player->name}' atualizado com sucesso!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Players $player)
    {

        $affected = $this->playersRepository->delete($player);

        if (!$affected) {
            return redirect()->route('players.index')
                ->with('message.error', "Houve uma falha no processo de exclusão do jogador '{$player->name}'!");
        }

        return redirect()->route('players.index')
            ->with('message.success', "Jogador '{$player->name}' removido com sucesso!");

    }
}
