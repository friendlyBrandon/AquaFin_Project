@php
    $isMobile = preg_match('/Android|iPhone|iPad/i', request()->userAgent());
@endphp
@if(!$isMobile)
<nav class="navbar">
    <div class="nav-left">
        <a href="{{ route('dashboard') }}" class="logo-navbar">
           
            <img src="{{ asset('images/transparant-logo.png') }}" class="logo-navbar">
            
        </a>
    </div>

    <div class="nav-center" id="navCenter">
        @auth
            <a href="/materials">Materiaal</a>
            <a href="/forecast">Neerslag Voorspelling</a>
            @php
                $contactCount = \App\Models\Message::where('receiver_id', auth()->id())
                                       ->where('is_read', false)
                                       ->count();
            @endphp
            <a href="/contact" style="display: inline-flex; align-items: center;">
                Contact
                @if($contactCount > 0)
                    <span style="background-color: #007bff; color: white; border-radius: 50%; padding: 2px 7px; font-size: 0.75em; font-weight: bold; margin-left: 6px;">
                        {{ $contactCount }}
                    </span>
                @endif
            </a>
            <a href="{{ route('profile.edit') }}">Profiel</a>
            @php
                $cartCount = count(session('cart', []));
                
                $navPending = 0;
                if (auth()->user()->is_admin != 1 && auth()->user()->is_stockMedewerker != 1) {
                    $navPending = \App\Models\Orderlog::where('user_id', auth()->id())
                                                      ->where('status', 'pending')
                                                      ->get()
                                                      ->groupBy('order_id')
                                                      ->count();
                }
            @endphp

            <a href="{{ route('cart.index') }}" style="position: relative; display: inline-flex; align-items: center;">
                Winkelmand
                
                @if($cartCount > 0)
                    <span style="background-color: #dc3545; color: white; border-radius: 50%; padding: 2px 7px; font-size: 0.75em; font-weight: bold; margin-left: 6px;">
                        {{ $cartCount }}
                    </span>
                @endif

            </a>

            @if(auth()->user()->is_admin == 1 || auth()->user()->is_stockMedewerker == 1)
                
                @php
                    $navPending = \App\Models\Orderlog::where('status', 'pending')
                                                      ->distinct('order_id')
                                                      ->count('order_id');
                @endphp

                <a href="/orderlog" style="position: relative; display: inline-flex; align-items: center;">
                    Bestellog
                    @if($navPending > 0)
                        <span title="Bestellingen in afwachting" style="background-color: #fd7e14; color: white; border-radius: 50%; padding: 2px 7px; font-size: 0.75em; font-weight: bold; margin-left: 6px;">
                            {{ $navPending }}
                        </span>
                    @endif
                </a>
            @endif
            
            <form method="POST" action="{{ route('logout') }}" style="display: inline; margin-left: 10px;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        @endauth
    </div>
</nav>
@endif
@if($isMobile)
<nav class="navbar-mobile">

    <div class="mobile-top">
        <a href="javascript:void(0)" id="mobileLogoToggle">
            <img src="{{ asset('images/transparant-logo.png') }}" class="logo-mobile">
        </a>
    </div>

    <div class="nav-mobile-center" id="mobileMenu">
        @auth
            <a href="/dashboard">Dashboard</a>
            <a href="/materials">Materiaal</a>
            <a href="/forecast">Neerslag Voorspelling</a>
            <a href="/contact">Contact</a>
            <a href="{{ route('profile.edit') }}">Profiel</a>

            <a href="{{ route('cart.index') }}">Winkelmand</a>

            @if(auth()->user()->is_admin == 1 || auth()->user()->is_stockMedewerker == 1)
                <a href="/orderlog">Bestellog</a>
            @endif

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="logout-btn">Logout</button>
            </form>
        @endauth
    </div>

</nav>
@endif
<script>
document.addEventListener("DOMContentLoaded", function () {

    const logo = document.getElementById("mobileLogoToggle");
    const menu = document.getElementById("mobileMenu");

    if (logo) {
        logo.addEventListener("click", function () {
            menu.classList.toggle("active");
        });
    }

});
</script>