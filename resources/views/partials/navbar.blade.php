<nav class="navbar">
    <div class="nav-left">
        <a href="{{ route('dashboard') }}" class="logo">
            💧 Aquafin
        </a>
    </div>

    <div class="nav-center">
        <a href="/materials">Materials</a>
        <a href="#">Flood Risk Forecast</a>
        <a href="#">Messages</a>
    </div>

    <div class="nav-right">
        @auth
            <a href="#">🛒 Cart</a>
            <a href="#">Profile</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="logout-btn">Logout</button>
            </form>
       
        @endauth
    </div>
</nav>