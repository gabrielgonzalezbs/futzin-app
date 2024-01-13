<section>
    <div>
        <x-input-label for="name" value="Nome" />
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $player->name ?? '')" required autofocus />
        <x-input-error class="mt-2" :messages="$errors->get('name')" />
    </div>

    <div>
        <x-input-label for="email" value="E-mail" />
        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $player->email ?? '')" />
        <x-input-error class="mt-2" :messages="$errors->get('email')" />
    </div>

    <div>
        <x-input-label for="skills_levels" value="Nível de habilidade" />
        <x-select-input id="skills_levels" name="skills_levels" type="skills_levels" class="mt-1 block w-full" :value="old('skills_levels', $player->skills_levels ?? '')" required >
            <option value="" disabled selected>-- SELECIONE --</option>
            <option value="1" @php echo old('goalkeeper', $player->skills_levels ?? '') == '1' ? 'selected' : '' @endphp >Bola mucha</option>
            <option value="2" @php echo old('goalkeeper', $player->skills_levels ?? '') == '2' ? 'selected' : '' @endphp >Perna de pau</option>
            <option value="3" @php echo old('goalkeeper', $player->skills_levels ?? '') == '3' ? 'selected' : '' @endphp >Ta na média</option>
            <option value="4" @php echo old('goalkeeper', $player->skills_levels ?? '') == '4' ? 'selected' : '' @endphp >Jogador Caro</option>
            <option value="5" @php echo old('goalkeeper', $player->skills_levels ?? '') == '5' ? 'selected' : '' @endphp >Craque</option>
        </x-select-input>
        <x-input-error class="mt-2" :messages="$errors->get('skills_levels')" />
    </div>

    <div>
        <x-input-label for="goalkeeper" value="É goleiro?" />
        <x-select-input id="goalkeeper" name="goalkeeper" type="goalkeeper" class="mt-1 block w-full" required >
            <option value="0" @php echo old('goalkeeper', $player->goalkeeper ?? '') == '0' ? 'selected' : '' @endphp >Não</option>
            <option value="1" @php echo old('goalkeeper', $player->goalkeeper ?? '') == '1' ? 'selected' : '' @endphp >Sim</option>
        </x-select-input>
        <x-input-error class="mt-2" :messages="$errors->get('goalkeeper')" />
    </div>

    <div class="flex items-center gap-4 mt-4">
        <x-primary-button>Salvar</x-primary-button>

        @if (session('status') === 'profile-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600 dark:text-gray-400"
            >Salvo</p>
        @endif
    </div>
</section>
