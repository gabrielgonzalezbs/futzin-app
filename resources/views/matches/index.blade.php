<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Partidas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="flex justify-end">
                        <x-primary-href-button class="mb-4" title="Clique para cadastrar uma nova partida" :href="route('matches.create')">
                            <i class="fa-solid fa-user-plus pr-2"></i>
                            Nova Partida
                        </x-primary-href-button>
                    </div>

                    <table class="border-collapse w-full border border-gray-400 dark:border-gray-500 dark:bg-gray-800 text-sm shadow-sm">
                        <thead>
                          <tr class="bg-gray-300 dark:bg-gray-300">
                            <th class="w-1/6 border border-gray-300 dark:border-gray-600 font-semibold p-4 text-gray-900 dark:text-gray-900 text-left">
                                Descrição
                            </th>
                            <th class="w-1/6 border border-gray-300 dark:border-gray-600 font-semibold p-4 text-gray-900 dark:text-gray-900 text-left">
                                Data e Hora
                            </th>
                            <th class="w-1/6 border border-gray-300 dark:border-gray-600 font-semibold p-4 text-gray-900 dark:text-gray-900 text-left">
                                Localização
                            </th>
                            <th class="w-1/6 border border-gray-300 dark:border-gray-600 font-semibold p-4 text-gray-900 dark:text-gray-900 text-left">
                                Status
                            </th>
                            <th class="w-1/6 border border-gray-300 dark:border-gray-600 font-semibold p-4 text-gray-900 dark:text-gray-900 text-left">
                                Ações
                            </th>
                          </tr>
                        </thead>
                        <tbody>

                            @if(!empty($matches))
                                @foreach ($matches as $match)
                                <tr class="hover:bg-gray-700">
                                    <td class="border border-gray-300 dark:border-gray-700 p-4 text-gray-700 dark:text-gray-200">
                                        {{$match->description}}
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-700 p-4 text-gray-700 dark:text-gray-200">
                                        {{date('d/m/Y', strtotime($match->game_day))}} - {{$match->game_hour}}
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-700 p-4 text-gray-700 dark:text-gray-200">
                                        {{$match->location}}
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-700 p-4 text-gray-700 dark:text-gray-200">
                                        {{$match->getStatus()}}
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-700 p-4 text-gray-700 dark:text-gray-200">
                                        <div class="flex justify-center">
                                            <x-primary-href-button :href="route('matches.edit', $match->id)" class="mr-2" title="Clique para editar a partida">
                                                <i class="fa-solid fa-user-pen"></i>
                                            </x-primary-href-button>

                                            <form action="{{ route('matches.random', $match->id) }}" method="post">
                                                @csrf

                                                <x-primary-button class="mr-2" title="Clique para realizar o sorteio" onclick="return confirm('Tem certeza que deseja realizar o sorteio da partida?')">
                                                    <i class="fa-solid fa-shuffle"></i>
                                                </x-primary-button>
                                            </form>

                                            <form action="{{ route('matches.destroy', $match->id) }}" method="post">
                                                @csrf
                                                @method('delete')

                                                <x-danger-button title="Clique para remover o jogador" onclick="return confirm('Tem certeza que deseja realizar a exclusão da partida?')">
                                                    <i class="fa-regular fa-trash-can"></i>
                                                </x-danger-button>
                                            </form>
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
            </div>
        </div>
    </div>
</x-app-layout>
