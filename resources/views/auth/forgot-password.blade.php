<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your username and we will direct you to the password reset page.') }}
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div>
            <x-input-label for="username" :value="__('Username')" />
            
            <x-text-input id="username" class="block mt-1 w-full" 
                          type="text" 
                          name="username" 
                          :value="old('username')" 
                          required autofocus />
                          
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Continue to Reset') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>