<section>
    <div>
        <x-input-label for="description" value="Descrição" />
        <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" :value="old('description', $match->description ?? '')" required autofocus />
        <x-input-error class="mt-2" :messages="$errors->get('description')" />
    </div>

    <div>
        <x-input-label for="game_day" value="Dia do Jogo" />
        <x-text-input id="game_day" name="game_day" type="date" :min="date('Y-m-d')" class="mt-1 block w-full" :value="old('game_day', $match->game_day ?? '')" />
        <x-input-error class="mt-2" :messages="$errors->get('game_day')" />
    </div>

    <div>
        <x-input-label for="game_hour" value="Hora do Jogo" />
        <x-text-input id="game_hour" name="game_hour" type="time" class="mt-1 block w-full" :value="old('game_hour', $match->game_hour ?? '')" />
        <x-input-error class="mt-2" :messages="$errors->get('game_hour')" />
    </div>

    <div>
        <x-input-label for="location" value="Local do Jogo" />
        <x-text-input id="location" name="location" type="text" class="mt-1 block w-full" :value="old('location', $match->location ?? '')" />
        <x-input-error class="mt-2" :messages="$errors->get('location')" />
    </div>

    <div>
        <x-input-label for="players_per_team" value="Número de jogadores por time" />
        <x-text-input id="players_per_team" name="players_per_team" type="number" class="mt-1 block w-full" :value="old('players_per_team', $match->players_per_team ?? '')" />
            <x-input-error class="mt-2" :messages="$errors->get('players_per_team')" />
    </div>

</section>
