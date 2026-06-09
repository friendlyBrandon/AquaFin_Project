<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profielgegevens') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update de profielgegevens van uw account.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        @if (auth()->user()->is_stockMedewerker == 1)
            <div>
                <p class="function">Functie: Warehouse worker</p>
            </div>
        @elseif (auth()->user()->is_admin == 1)
            <div>
                <p class="function">Functie: Admin</p>
            </div>
        @else
            <div>
                <p class="function">Functie: Technieker</p>
            </div>
        @endif
        <div>
    <x-input-label for="provincie" :value="__('Provincie:')" />

    <select id="provincie" name="provincie" required
        class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">

        <option value="">Selecteer een provincie</option>

        <option value="Antwerpen"
            {{ old('provincie', $user->provincie) == 'Antwerpen' ? 'selected' : '' }}>
            Antwerpen
        </option>

        <option value="Oost-Vlaanderen"
            {{ old('provincie', $user->provincie) == 'Oost-Vlaanderen' ? 'selected' : '' }}>
            Oost-Vlaanderen
        </option>

        <option value="West-Vlaanderen"
            {{ old('provincie', $user->provincie) == 'West-Vlaanderen' ? 'selected' : '' }}>
            West-Vlaanderen
        </option>

        <option value="Vlaams-Brabant"
            {{ old('provincie', $user->provincie) == 'Vlaams-Brabant' ? 'selected' : '' }}>
            Vlaams-Brabant
        </option>

        <option value="Limburg"
            {{ old('provincie', $user->provincie) == 'Limburg' ? 'selected' : '' }}>
            Limburg
        </option>
    </select>

    <x-input-error :messages="$errors->get('provincie')" class="mt-2" />
</div>
        <div>
            <x-input-label for="username" :value="__('Gebruikersnaam:')" />
            <x-text-input id="username" type="text" class="mt-1 block w-full" :value="$user->username" readonly />
        </div>
    </form>
</section>