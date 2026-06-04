<nav class="navbar">
    <div class="nav-left">
        <a href="{{ route('dashboard') }}" class="logo">
            💧 Aquafin
        </a>
    </div>

    <div class="nav-center">
<<<<<<< HEAD
        <a href="/materials">Materials</a>
=======
        @auth
        <a href="#">Materials</a>
>>>>>>> f19964b3bc6ccc89a526fe9b103ecc98f5a927bc
        <a href="#">Flood Risk Forecast</a>
        <a href="#">Messages</a>
        <a href="#">🛒 Cart</a>
        <a href="{{ route('profile.edit') }}">Profile</a>
        <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="logout-btn">Logout</button>
        </form>
       
        @endauth
    </div>
</nav>