<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Jogadores
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="flex justify-end">
                        <x-primary-href-button class="mb-4" title="Clique para cadastrar um novo jogador" :href="route('players.create')">
                            <i class="fa-solid fa-user-plus pr-2"></i>
                            Novo Jogador
                        </x-primary-href-button>
                    </div>

                    <table class="border-collapse w-full border border-gray-400 dark:border-gray-500 dark:bg-gray-800 text-sm shadow-sm">
                        <thead>
                          <tr class="bg-gray-300 dark:bg-gray-300">
                            <th class="w-1/6 border border-gray-300 dark:border-gray-600 font-semibold p-4 text-gray-900 dark:text-gray-900 text-left">
                                Nome
                            </th>
                            <th class="w-1/6 border border-gray-300 dark:border-gray-600 font-semibold p-4 text-gray-900 dark:text-gray-900 text-left">
                                E-mail
                            </th>
                            <th class="w-1/6 border border-gray-300 dark:border-gray-600 font-semibold p-4 text-gray-900 dark:text-gray-900 text-left">
                                Nível de habilidade
                            </th>
                            <th class="w-1/6 border border-gray-300 dark:border-gray-600 font-semibold p-4 text-gray-900 dark:text-gray-900 text-left">
                                Goleiro
                            </th>
                            <th class="w-1/6 border border-gray-300 dark:border-gray-600 font-semibold p-4 text-gray-900 dark:text-gray-900 text-left">
                                Ações
                            </th>
                          </tr>
                        </thead>
                        <tbody>

                            @if(!empty($players))
                                @foreach ($players as $player)
                                <tr class="hover:bg-gray-700">
                                    <td class="border border-gray-300 dark:border-gray-700 p-4 text-gray-700 dark:text-gray-200">
                                        {{$player->name}}
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-700 p-4 text-gray-700 dark:text-gray-200">
                                        {{$player->email}}
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-700 p-4 text-gray-700 dark:text-gray-200">
                                        {{$player->skills_levels}}
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-700 p-4 text-gray-700 dark:text-gray-200">
                                        {{$player->goalkeeper}}
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-700 p-4 text-gray-700 dark:text-gray-200">
                                        <div class="flex justify-center">
                                            <x-primary-href-button :href="route('players.edit', $player->id)" class="mr-2" title="Clique para editaro jogador">
                                                <i class="fa-solid fa-user-pen"></i>
                                            </x-primary-href-button>

                                            <form action="{{ route('players.destroy', $player->id) }}" method="post">
                                                @csrf
                                                @method('delete')

                                                <x-danger-button title="Clique para remover o jogador" onclick="return confirm('Tem certeza que deseja realizar a exclusão do jogador?')">
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
