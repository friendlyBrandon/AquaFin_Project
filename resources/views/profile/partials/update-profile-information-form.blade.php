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
            <x-text-input id="username" type="text" class="mt-1 block w-full" :value="$user->username" readonly />
    </div>

    <form method="post" action="{{ route('profile.update') }}" class="function">
        @csrf
        @method('patch')

        @if (auth()->user()->is_stockMedewerker == 1)
            <div>
                <p style="color:black;">Functie: Stock Medewerker</p>
            </div>
        @elseif (auth()->user()->is_admin == 1)
            <div>
                <p style="color:black;">Functie: Admin</p>
            </div>
        @else
            <div>
               <p style="color:black;">Functie: Technieker</p>
            </div>
        @endif   
    </form>

    <div>
    <x-input-label :value="__('Provincie:')" /> <span >{{ $user->provincie }}</span>
    </div>

</section>