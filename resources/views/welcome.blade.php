@extends('layouts.app')

@section('content')
<div class="container">


    <div class="left-side">
        <h1>Welkom bij Aquafin</h1>

        <p>
            Bestel en raadpleeg materialen voor onderhouds-, herstel- en bouwwerkzaamheden.
        </p>

        
    </div>

    <div class="right-side">
        <img src="{{ asset('images/transparant-logo.png') }}" class="logo-topright">
        <div class="login-card">
            <h2>Material Management</h2>

            <p>Log in of maak een account.</p>

            <a href="{{ route('login') }}" class="btn-login">
                Inloggen
            </a>

            <a href="{{ route('register') }}" class="btn-register">
                Registeren
            </a>
        </div>
    </div>

</div>
@endsection