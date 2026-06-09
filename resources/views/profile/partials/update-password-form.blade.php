<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Wachtwoord bijwerken') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Zorg ervoor dat uw account een lang, willekeurig wachtwoord gebruikt om veilig te blijven.') }}
        </p>
    </header>
<br>
    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Huidig wachtwoord:')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('Nieuw wachtwoord:')" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Bevestig wachtwoord:')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>
<br>
        <div class="profile-btn">
            <x-primary-button>{{ __('Bewaar Wachtwoord') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Bewaard.') }}</p>
            @endif
        </div>
    </form>
</section>
