<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-2">
        <div>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="font-bold text-xl mb-2 text-gray-800 dark:text-gray-200 mt-4">
                                <i class="fa-solid fa-calendar mr-2"></i>
                                Próxima partida
                            </div>

                            @if ($nextMatch)
                                <p class="text-gray-800 dark:text-gray-200">
                                    Partida: {{$nextMatch->description}} <br>
                                    Local: {{$nextMatch->location}} <br>
                                    Data: {{date('d/m/Y', strtotime($nextMatch->game_day))}} - {{$nextMatch->game_hour}}

                                </p>

                                @if ($nextMatch->status === 'A')
                                    <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
                                        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                                        <p>O sorteio da partida ainda não foi realizado</p>
                                    </div>
                                @endif

                                @if ($nextMatch->status === 'R')
                                    <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3 mt-2" role="alert">
                                        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>

                                        <a href="{{route('matches.show', $nextMatch->id)}}">
                                            Clique ver a escação dos times!
                                        </a>
                                    </div>
                                @endif

                            @else

                                <p class="text-gray-800 dark:text-gray-200">
                                    Você não possuí nenhuma partida marcada para os próximos dias
                                </p>

                            @endif


                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="font-bold text-xl mb-2 text-gray-800 dark:text-gray-200 mt-4">
                                <i class="fa-solid fa-users mr-2"></i>
                                jogadores Cadastrados
                            </div>

                            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
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
                                                </tr>
                                            @endforeach
                                        @else

                                            <tr>
                                                <td colspan="3" class="border border-gray-300 dark:border-gray-700 p-4 text-gray-700 dark:text-gray-200">
                                                    Nenhum jogador cadastrado!
                                                </td>
                                            </tr>

                                        @endif

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
