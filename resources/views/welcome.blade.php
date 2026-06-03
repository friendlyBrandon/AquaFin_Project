@extends('layouts.app')

@section('content')
<div class="container">


    <div class="left-side">
        <h1>Welkom bij Aquafin</h1>

        <p>
            Bestel en raadpleeg materialen voor onderhouds-,
            herstel- en bouwwerkzaamheden.
        </p>

        
    </div>

    <div class="right-side">
        <img src="{{ asset('images/logo.png') }}" class="logo-topright">
        <div class="login-card">
            <h2>Materiaalbeheer</h2>

            <p>Log in of maak een account aan.</p>

            <a href="{{ route('login') }}" class="btn-login">
                Inloggen
            </a>

            <a href="{{ route('register') }}" class="btn-register">
                Registreren
            </a>
        </div>
    </div>

</div>
@endsection