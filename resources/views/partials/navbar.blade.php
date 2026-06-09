<nav class="navbar">
    <div class="nav-left">
        <a href="{{ route('dashboard') }}" class="logo">
            💧 Aquafin
        </a>
    </div>

    <div class="nav-center">
        @auth
<<<<<<< HEAD
        <a href="/materials">Materials</a>
        <a href="#">Flood Risk Forecast</a>
        <a href="#">Messages</a>

        <a href="/cart">🛒 Cart</a>

=======
        <a href="/materials">Materiaal</a>
        <a href="#">Neerslag Voorspelling</a>
        <a href="/contact">Contact</a>
>>>>>>> ecd5df849b3a5a583c16dc889ee53e7573f8b6cc
         @if(auth()->user()->is_admin == 1) 
        <a href="#">Bestellog</a>
        @else 
        @endif
<<<<<<< HEAD

        <a href="{{ route('profile.edit') }}">Profile</a>
        <form method="POST" action="{{ route('logout') }}">
=======
        <a href="#">🛒 Winkelmand</a>
        <a href="{{ route('profile.edit') }}">Profiel</a>
       <form method="POST" action="{{ route('logout') }}">
>>>>>>> ecd5df849b3a5a583c16dc889ee53e7573f8b6cc
                @csrf
                <button class="logout-btn">Logout</button>
        </form>
       
        @endauth
    </div>
</nav>