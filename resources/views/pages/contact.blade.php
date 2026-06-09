@extends('layouts.dashboard') 

@section('content')
<div>
    <div>
        <h2>Welkom, {{ $user->username }}</h2>
        <p><strong>Functie:</strong> 
        @if($user->is_admin == 1)
            Admin
        @elseif($user->is_stockmedewerker == 1)
            Stockmedewerker
         @else
            Technieker
        @endif
    </p>
    </div>

    @if($actie === 'overzicht' || $actie === 'bekijk')
        <div>
            <a href="/contact?actie=nieuw_kies">
                <button type="button">Nieuw formulier aanmaken</button>
            </a>
        </div>
    @endif

    <hr>

    @if(session('success'))
        <div><strong>{{ session('success') }}</strong></div><br>
    @endif
    @if ($errors->any())
        <div><strong>Fout:</strong><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div><br>
    @endif


    @if($actie === 'overzicht')
        
        <h2>Mijn Inbox</h2>

        <h3>Ontvangen formulieren</h3>
        <ul>
            @forelse($berichten->where('receiver_id', $user->id) as $bericht)
                <li>
                    <strong>Van:</strong> {{ $bericht->sender->username }}<br>
                    <strong>Onderwerp:</strong> {{ $bericht->subject }}<br>
                    <strong>Datum:</strong> {{ $bericht->created_at->format('d-m-Y H:i') }}<br>
                    <a href="/contact?actie=bekijk&bericht_id={{ $bericht->id }}">[ Bekijk dit formulier ]</a>
                </li>
                <br>
            @empty
                <li>Je hebt nog geen formulieren ontvangen.</li>
            @endforelse
        </ul>

        <hr>

        <h3>Verzonden formulieren</h3>
        <ul>
            @forelse($berichten->where('sender_id', $user->id) as $bericht)
                <li>
                    <strong>Aan:</strong> {{ $bericht->receiver->username }}<br>
                    <strong>Onderwerp:</strong> {{ $bericht->subject }}<br>
                    <strong>Datum:</strong> {{ $bericht->created_at->format('d-m-Y H:i') }}<br>
                    <a href="/contact?actie=bekijk&bericht_id={{ $bericht->id }}">[ Bekijk dit formulier ]</a>
                </li>
                <br>
            @empty
                <li>Je hebt nog geen formulieren verstuurd.</li>
            @endforelse
        </ul>


    @elseif($actie === 'nieuw_kies')
        <h3>Stap 1: Kies een ontvanger</h3>
        <ul>
            @forelse($medewerkers as $medewerker)
                <li>
                    <strong>{{ $medewerker->username }}</strong> 
                    ({{ $medewerker->is_admin ? 'Admin' : 'Stockmedewerker' }})
                    <a href="/contact?actie=nieuw_formulier&ontvanger_id={{ $medewerker->id }}">[ Selecteer ]</a>
                </li>
            @empty
                <li>Er zijn geen andere medewerkers gevonden.</li>
            @endforelse
        </ul>
        <br>
        <a href="/contact">Terug naar overzicht</a>


    @elseif($actie === 'nieuw_formulier' && isset($gekozenOntvanger))
        <h3>Stap 2: Formulier invullen</h3>
        <p><strong>Aan:</strong> {{ $gekozenOntvanger->username }}</p>
        
        <form method="POST" action="/contact/verstuur" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="receiver_id" value="{{ $gekozenOntvanger->id }}">
            
            <label for="subject">Onderwerp:</label><br>
            <input type="text" name="subject" id="subject" required><br><br>

            <label for="message">Bericht:</label><br>
            <textarea name="message" id="message" rows="6" required></textarea><br><br>

            <label for="attachment">Bestand uploaden (optioneel):</label><br>
            <input type="file" name="attachment" id="attachment"><br><br>

            <button type="submit">Formulier versturen</button>
        </form>
        <br>
        <a href="/contact">Annuleren en terug naar overzicht</a>


    @elseif($actie === 'bekijk' && isset($bekijkBericht))
        <h3>Formulier Details</h3>
        
        <p><strong>Verzonden door:</strong> {{ $bekijkBericht->sender->username }}</p>
        <p><strong>Verzonden aan:</strong> {{ $bekijkBericht->receiver->username }}</p>
        <p><strong>Datum:</strong> {{ $bekijkBericht->created_at->format('d-m-Y H:i') }}</p>
        <p><strong>Onderwerp:</strong> {{ $bekijkBericht->subject }}</p>
        
        <hr>
        <p><strong>Bericht:</strong></p>
        <p>{{ $bekijkBericht->body }}</p>
        <hr>

        @if($bekijkBericht->file_path)
            <p><strong>Bijlage:</strong> <a href="{{ asset('storage/' . $bekijkBericht->file_path) }}" target="_blank">Download / Bekijk Bestand</a></p>
        @endif

        <br>
        <a href="/contact">Terug naar overzicht</a>

    @endif

</div>
@endsection