<nav class="navbar">
    <div class="nav-left">
        <a href="{{ route('dashboard') }}" class="logo">
            💧 Aquafin
        </a>
    </div>

    <div class="nav-center">
        @auth
            <a href="/materials">Materiaal</a>
            <a href="/forecast">Neerslag Voorspelling</a>
            <a href="/contact">Contact</a>
            

            <a href="{{ route('profile.edit') }}">Profiel</a>

            @php
                $cartCount = count(session('cart', []));
            @endphp

            <a href="{{ route('cart.index') }}" style="position: relative; display: inline-flex; align-items: center;">
                Winkelmand
                @if($cartCount > 0)
                    <span style="background-color: #dc3545; color: white; border-radius: 50%; padding: 2px 7px; font-size: 0.75em; font-weight: bold; margin-left: 6px;">
                        {{ $cartCount }}
                    </span>
                @endif
            </a>

            @if(auth()->user()->is_admin == 1 || auth()->user()->is_stockmedewerker == 1)
                <a href="/orderlog">Bestellog</a>
            @endif            
            
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        @endauth
    </div>
</nav>