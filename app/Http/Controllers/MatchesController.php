<?php

namespace App\Http\Controllers;

use App\Http\Requests\MatchesRequest;
use App\Models\Matches;
use App\Models\Players;
use App\Repositories\MatchesRepository;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\Auth;

use function Psy\debug;

class MatchesController extends Controller
{

    public function __construct(
        private MatchesRepository $matchesRepository
    )
    {

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $matches = Matches::where('user_id', Auth::user()->id)
            ->get();

        return view('matches.index', ['matches' => $matches]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $players = Players::where('user_id', Auth::user()->id)
            ->get();

        return view('matches.forms.create', ['players' => $players]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MatchesRequest $request)
    {

        $matches = $this->matchesRepository->create($request);

        return redirect()->route('matches.index')
            ->with('message.success', "Partida '{$matches->description}' cadastrada com sucesso!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Matches $match)
    {
        $players = Players::where('user_id', Auth::user()->id)
        ->leftJoin('players_matches', function (JoinClause $join) use ($match) {
            $join->on('players.id', '=', 'players_matches.player_id')
                ->where('players_matches.matche_id', '=', $match->id);
            }
        )
        ->where("players_matches.confirmed", "=", 1)
        ->select('players.id', 'players.name', 'players.skills_levels', 'players.goalkeeper', 'players_matches.id AS players_matches_id', 'players_matches.confirmed', 'players_matches.team_name')
        ->orderByRaw('players_matches.team_name, players.goalkeeper DESC, players.skills_levels DESC')
        ->get();

    return view('matches.lineup', ['match' => $match, 'players' => $players]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Matches $match)
    {

        $players = Players::where('user_id', Auth::user()->id)
            ->leftJoin('players_matches', function (JoinClause $join) use ($match) {
                    $join->on('players.id', '=', 'players_matches.player_id')
                        ->where('players_matches.matche_id', '=', $match->id);
                }
            )
            ->select('players.id', 'players.name', 'players.skills_levels', 'players.goalkeeper', 'players_matches.id AS players_matches_id', 'players_matches.confirmed')
            // ->whereRaw("(players_matches.id IS NULL OR players_matches.matche_id = ?)", $match->id)
            ->get();

        return view('matches.forms.update', ['match' => $match, 'players' => $players]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MatchesRequest $request, Matches $match)
    {
        $this->matchesRepository->update($request, $match);

        return redirect()->route('matches.index')
            ->with('message.success', "Partida '{$match->description}' atualizada com sucesso!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Matches $match)
    {

        $affected = $this->matchesRepository->delete($match);

        if (!$affected) {
            return redirect()->route('matches.index')
                ->with('message.error', "Houve uma falha no processo de exclusão da partida '{$match->description}'!");
        }

        return redirect()->route('matches.index')
            ->with('message.success', "Partida '{$match->description}' removida com sucesso!");

    }

    /**
     * Assembles teams and players
     */
    public function random(Matches $match)
    {

        $players = $match->matchesPlayers()
            ->join('players', 'players.id', '=', 'players_matches.player_id')
            ->where("players_matches.confirmed", "=", 1)
            ->orderByRaw('players.goalkeeper DESC, players.skills_levels DESC')
            ->get();

        $minimumNumberPlayers = $match->players_per_team * 2;

        if ($minimumNumberPlayers > $players->count()) {
            return redirect()->route('matches.index')
                ->with('message.error', "A partida não tem o número mínimo de joragores confirmados!");
        }

        $affected = $this->matchesRepository->markeSort($match, $players);

        if (!$affected) {
            return redirect()->route('matches.index')
                ->with('message.error', "Houve uma falha no processo de sorteio da partida '{$match->description}'!");
        }

        return redirect()->route('matches.index')
                ->with('message.success', "Sorteio realizado com sucesso!");
    }

}
