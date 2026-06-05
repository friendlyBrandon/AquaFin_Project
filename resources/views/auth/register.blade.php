<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Provincie -->
        <div>
            <x-input-label for="provincie" :value="__('Provincie')" />

            <select id="provincie" name="provincie" required
                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option value="">Selecteer een provincie</option>
                <option value="Antwerpen" {{ old('provincie') == 'Antwerpen' ? 'selected' : '' }}>Antwerpen</option>
                <option value="Oost-Vlaanderen" {{ old('provincie') == 'Oost-Vlaanderen' ? 'selected' : '' }}>
                    Oost-Vlaanderen</option>
                <option value="West-Vlaanderen" {{ old('provincie') == 'West-Vlaanderen' ? 'selected' : '' }}>
                    West-Vlaanderen</option>
                <option value="Vlaams-Brabant" {{ old('provincie') == 'Vlaams-Brabant' ? 'selected' : '' }}>Vlaams-Brabant
                </option>
                <option value="Limburg" {{ old('provincie') == 'Limburg' ? 'selected' : '' }}>Limburg</option>
            </select>

            <x-input-error :messages="$errors->get('provincie')" class="mt-2" />
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Voornaam:')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Full name -->
        <div class="mt-4">
            <x-input-label for="fullname" :value="__('Achternaam:')" />
            <x-text-input id="fullname" class="block mt-1 w-full" type="text" name="fullname" :value="old('fullname')" required autocomplete="fullname" />
            <x-input-error :messages="$errors->get('fullname')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Wachtwoord:')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Bevestig wachtwoord')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Al een account?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Registeer') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>