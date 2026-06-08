<nav class="navbar">
    <div class="nav-left">
        <a href="{{ route('dashboard') }}" class="logo">
            💧 Aquafin
        </a>
    </div>

    <div class="nav-center">
        @auth
        <a href="/materials">Materiaal</a>
        <a href="#">Neerslag Voorspelling</a>
        <a href="/contact">Contact</a>
         @if(auth()->user()->is_admin == 1) 
        <a href="#">Bestellog</a>
        @else 
        @endif
        <a href="#">🛒 Winkelmand</a>
        <a href="{{ route('profile.edit') }}">Profiel</a>
       <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="logout-btn">Logout</button>
        </form>
       
        @endauth
    </div>
</nav>