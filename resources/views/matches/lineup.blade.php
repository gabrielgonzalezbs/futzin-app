<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Escalação da partida - {{ $match->description }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="max-w-sm rounded overflow-hidden shadow-lg">
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2 text-gray-800 dark:text-gray-200">
                            <i class="fa-solid fa-location-dot mr-2"></i>
                            Local da Partida
                        </div>
                        <p class="text-gray-800 dark:text-gray-200">
                            {{ $match->location }}
                        </p>
                    </div>
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2 text-gray-800 dark:text-gray-200">
                            <i class="fa-solid fa-calendar mr-2"></i>
                            Data e hora
                        </div>
                        <p class="text-gray-800 dark:text-gray-200">
                            {{date('d/m/Y', strtotime($match->game_day))}} - {{$match->game_hour}}
                        </p>
                    </div>
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2 text-gray-800 dark:text-gray-200">
                            <i class="fa-solid fa-users mr-2"></i>
                            Número de jogadores por time
                        </div>
                        <p class="text-gray-800 dark:text-gray-200">
                            A partida terá <span class="font-bold text-xl">{{$match->players_per_team}}</span> jogadores por time.
                        </p>
                    </div>

                    @if (!empty($players))
                        @php
                            $newGroup = '';
                            $oldGroup = '';
                        @endphp

                        <div class="px-6 py-4">
                            @foreach ($players as $player)

                                @php
                                    $newGroup = $player->team_name;
                                @endphp


                                    @if ($newGroup != $oldGroup)
                                        <hr>

                                        <div class="font-bold text-xl mb-2 text-gray-800 dark:text-gray-200 mt-4">
                                            <i class="fa-solid fa-users-viewfinder mr-2"></i>
                                            Grupo - {{ $player->team_name }}
                                        </div>
                                    @endif

                                    <p class="text-gray-800 dark:text-gray-200">
                                        {{ $player->name }}

                                        @if ($player->goalkeeper === 1)
                                            <i class="fa-solid fa-hand ml-2" title="goleiro"></i>
                                        @endif

                                    </p>

                                @php
                                    $oldGroup = $newGroup;
                                @endphp
                            @endforeach

                        </div>

                    @endif

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
