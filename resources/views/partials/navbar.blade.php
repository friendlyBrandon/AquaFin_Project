<nav class="navbar">

    <div class="nav-left">

        <a href="{{ route('dashboard') }}" class="logo">
            Aquafin
        </a>

        <a href="{{ route('dashboard') }}">
            
            Dashboard
        </a>

        <a href="{{ route('materials.index') }}">
            Materialen
        </a>

        <a href="{{ route('flood.index') }}">
            Overstromingsrisico
        </a>

        <a href="{{ route('messages.index') }}">
            Berichten
        </a>

        @if(auth()->user()->is_admin)
            <a href="{{ route('orders.index') }}">
                Bestellingen
            </a>
        @endif

    </div>

    <div class="nav-right">

        <a href="{{ route('cart.index') }}">
            🛒
        </a>

        <a href="{{ route('profile.edit') }}">
            Profiel
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="logout-btn">
                Uitloggen
            </button>
        </form>

    </div>

</nav>