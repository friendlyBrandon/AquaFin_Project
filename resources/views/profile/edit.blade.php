@extends('layouts.dashboard')

@section('content')
<div class="profile-container">
<div class="contact-header">
        <h2>Welkom, {{ $user->username }}</h2>
        <p><strong>Functie:</strong> 
        @if($user->is_admin == 1)
            Admin
        @elseif($user->is_stockMedewerker == 1)
            Stockmedewerker
         @else
            Technieker
        @endif
    </p>
    </div>
     
    <div class="profile">
        <h1 class="title">Profiel</h1>
<br>
       
            <div class="profile-card">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="profile-card">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>       
    </div>
    </div>  
@endsection
