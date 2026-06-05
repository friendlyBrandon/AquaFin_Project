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
        <a href="#">Contact</a>
         @if(auth()->user()->is_admin == 1) 
        <a href="#">Bestellog</a>
        @else 
        @endif
        <a href="#">🛒 Winkelmand</a>
        <a href="{{ route('profile.edit') }}">Profiel</a>
        <a href="/materials">Materials</a>
        <a href="#">Flood Risk Forecast</a>
        <a href="#">Messages</a>
         @if(auth()->user()->is_admin == 1) 
        <a href="#">Order Log</a>
        @else 
        @endif
        <a href="#">🛒 Cart</a>
        <a href="{{ route('profile.edit') }}">Profile</a>
       <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="logout-btn">Logout</button>
        </form>
       
        @endauth
    </div>
</nav>