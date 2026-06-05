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
            <x-input-label for="username" :value="__('Gebruikersnaam:')" />
            <x-text-input id="username" type="text" class="mt-1 block w-full" :value="$user->username" readonly />
        </div>
    </form>
</section>