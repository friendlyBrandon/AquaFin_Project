<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profielgegevens') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Hieronder zijn de profielgegevens van uw account.") }}
        </p>
    </header>
    <br>
    
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <div>
        <x-input-label for="username" :value="__('Gebruikersnaam:')" />
        <x-text-input id="username" type="text" class="mt-1 block w-full bg-gray-100" :value="$user->username" readonly />
    </div>

    <br>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        @if (auth()->user()->is_stockMedewerker == 1)
            <div>
                <p style="color:black; font-weight: bold;">Functie: Stock Medewerker</p>
            </div>
        @elseif (auth()->user()->is_admin == 1)
            <div>
                <p style="color:black; font-weight: bold;">Functie: Admin</p>
            </div>
        @else
            <div>
               <p style="color:black; font-weight: bold;">Functie: Technieker</p>
            </div>
        @endif   

        <div>
            <x-input-label for="provincie" :value="__('Provincie:')" />

            <select id="provincie" name="provincie" required
                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option value="">Selecteer een provincie</option>
                <option value="Antwerpen" {{ old('provincie', $user->provincie) == 'Antwerpen' ? 'selected' : '' }}>Antwerpen</option>
                <option value="Gent" {{ old('provincie', $user->provincie) == 'Gent' ? 'selected' : '' }}>Oost-Vlaanderen</option>
                <option value="Brugge" {{ old('provincie', $user->provincie) == 'Brugge' ? 'selected' : '' }}>West-Vlaanderen</option>
                <option value="Leuven" {{ old('provincie', $user->provincie) == 'Leuven' ? 'selected' : '' }}>Vlaams-Brabant</option>
                <option value="Hasselt" {{ old('provincie', $user->provincie) == 'Hasselt' ? 'selected' : '' }}>Limburg</option>
            </select>

            <x-input-error class="mt-2" :messages="$errors->get('provincie')" />
        </div>

        <div class="flex items-center gap-4 mt-6">
            <x-primary-button>{{ __('Opslaan') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 font-bold"
                >{{ __('Opgeslagen.') }}</p>
            @endif
        </div>
    </form>
</section>