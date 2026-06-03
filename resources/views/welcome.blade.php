@extends('layouts.app')

@section('content')
<div class="container">


    <div class="left-side">
        <h1>Welcome to Aquafin</h1>

        <p>
            Order and consult materials for maintenance,
            repair, and construction work.
        </p>

        
    </div>

    <div class="right-side">
        <img src="{{ asset('images/logo.png') }}" class="logo-topright">
        <div class="login-card">
            <h2>Material Management</h2>

            <p>Log in or create an account.</p>

            <a href="{{ route('login') }}" class="btn-login">
                Log in
            </a>

            <a href="{{ route('register') }}" class="btn-register">
                Registrer
            </a>
        </div>
    </div>

</div>
@endsection