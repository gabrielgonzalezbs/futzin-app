<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edição da partida - {{ $match->description }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="post" action="{{ route('matches.update', $match->id) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('PATCH')

                        @include('matches.forms.form')

                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Jogador
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Habilidade
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            É goleiro?
                                        </th>
                                        <th scope="col" class="p-4">
                                            Jogadores Confirmados
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($players))
                                        @foreach ($players as $player)
                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    {{$player->name}}
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{$player->getSkillsLevels()}}
                                                </td>
                                                <td class="px-6 py-4">
                                                    {{$player->isGoalkeeper()}}
                                                </td>
                                                <td class="w-4 p-4">
                                                    <div class="flex items-center">
                                                        <input type="hidden" name="matchesPlayers[{{$player->id}}][id]" value="{{$player->players_matches_id}}">
                                                        <input type="hidden" name="matchesPlayers[{{$player->id}}][player_id]" value="{{$player->id}}">
                                                        <input name="matchesPlayers[{{$player->id}}][confirmed]"
                                                            @checked($player->confirmed == 1 ? true : false)
                                                            type="checkbox"
                                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else

                                        <tr>
                                            <td colspan="5" class="border border-gray-300 dark:border-gray-700 p-4 text-gray-700 dark:text-gray-200">
                                                Nenhum jogador cadastrado!
                                            </td>
                                        </tr>

                                    @endif

                                </tbody>
                            </table>

                        </div>

                        <hr>

                        <div class="flex items-center gap-4 mt-4">
                            <x-primary-button>Salvar</x-primary-button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
