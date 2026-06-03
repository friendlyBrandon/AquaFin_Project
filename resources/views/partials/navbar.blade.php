<nav class="navbar">
    <div class="nav-left">
        <a href="{{ route('home') }}" class="logo">
            <img src="{{ asset('images/aquafin-logo.png') }}" alt="Aquafin">
        </a>
    </div>

    <div class="nav-center">
        <a href="{{ route('materialen.index') }}">Materialen</a>
        <a href="{{ route('weersvoorspelling') }}">Weer & Risico</a>
        <a href="{{ route('messages.index') }}">Berichten</a>
        <a href="{{ route('order.logs') }}">Bestellogs</a>
        <a href="{{ route('profile') }}">Profiel</a>
    </div>

    <div class="nav-right">
        <a href="{{ route('winkelmand') }}" class="cart">🛒</a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="logout">Uitloggen</button>
        </form>
    </div>
</nav>