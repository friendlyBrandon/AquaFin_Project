@extends('layouts.dashboard') 

@section('content')
<div class="contact-container">
    <div class="contact-header">
        <h2>Welkom, {{ $user->username }}</h2>
        <p><strong>Functie:</strong> 
        @if($user->is_admin == 1)
            Admin
        @elseif($user->is_stockMedewerker == 1)
            Stock Medewerker
         @else
            Technieker
        @endif
    </p>
    </div>

    @if($actie === 'overzicht' || $actie === 'bekijk')
        <div>
            <a href="/contact?actie=nieuw_kies">
                <button type="button" class="contact-btn">Nieuw formulier aanmaken</button>
            </a>
        </div>
    @endif

    <br>

    @if(session('success'))
        <div><strong>{{ session('success') }}</strong></div><br>
    @endif
    @if ($errors->any())
        <div><strong>Fout:</strong><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div><br>
    @endif


    @if($actie === 'overzicht')

        <h2>Mijn Inbox</h2>

        <div class="contact-card">
            
            <h3>Ontvangen formulieren</h3>
            <ul>
                @forelse($berichten->where('receiver_id', $user->id) as $bericht)
                    <li>
                        <strong>Van:</strong> {{ $bericht->sender->username }}<br>
                        <strong>Onderwerp:</strong> {{ $bericht->subject }}<br>
                        <strong>Datum:</strong> {{ $bericht->created_at->format('d-m-Y H:i') }}<br>
                        <a href="/contact?actie=bekijk&bericht_id={{ $bericht->id }}" class="contact-link">[ Bekijk dit formulier ]</a>
                    </li>
                    <br>
                @empty
                    <p>Je hebt nog geen formulieren ontvangen.</p>
                @endforelse
            </ul>
        </div>
      
        <div class="contact-card">
            <hr>
            
            <h3>Verzonden formulieren</h3>
            <ul>
                @forelse($berichten->where('sender_id', $user->id) as $bericht)
                    <strong>Aan:</strong> {{ $bericht->receiver->username }}<br>
                    <strong>Onderwerp:</strong> {{ $bericht->subject }}<br>
                    <strong>Datum:</strong> {{ $bericht->created_at->format('d-m-Y H:i') }}
                    <br>
                    <a href="/contact?actie=bekijk&bericht_id={{ $bericht->id }}">
                        <button class ="contact-btn">Bekijk dit formulier</button>
                    </a>
                    <br>
                    <br>
                @empty
                    <p>Je hebt nog geen formulieren verstuurd.</p>
                @endforelse
            </ul>
        </div>

    @elseif($actie === 'nieuw_kies')
        <h3>Stap 1: Kies een ontvanger</h3>
        <br>
        <ul>
            @forelse($medewerkers as $medewerker)
                <li>
                    <strong>{{ $medewerker->username }}</strong> 
                    ({{ $medewerker->is_admin ? 'Admin' : 'Stockmedewerker' }})
                
                    <a href="/contact?actie=nieuw_formulier&ontvanger_id={{ $medewerker->id }}"><button type="button" class="contact-btn">SELECTEER</button></a>

                </li>
            @empty
                <li>Er zijn geen andere medewerkers gevonden.</li>
            @endforelse
        </ul>
        <br>
        <a href="/contact" class="contact-link">Terug naar overzicht</a>


    @elseif($actie === 'nieuw_formulier' && isset($gekozenOntvanger))
        <h3>Stap 2: Formulier invullen</h3>
        <p><strong>Aan:</strong> {{ $gekozenOntvanger->username }}</p>
        
        <div class="contact-form">

        <form method="POST" action="/contact/verstuur" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="receiver_id" value="{{ $gekozenOntvanger->id }}">
            
            <label for="subject">Onderwerp:</label><br>
            <input type="text" name="subject" id="subject" required><br><br>

            <label for="message">Bericht:</label><br>
            <textarea name="message" id="message" rows="6" required></textarea><br><br>

            <label for="attachment">Bestand uploaden (optioneel):</label><br>
            <input type="file" name="attachment" id="attachment"><br><br>

            <button type="submit"class="contact-btn">Formulier versturen</button>
        </form>
        <br>
        <a href="/contact" class="contact-link">Annuleren en terug naar overzicht</a>

        </div>

    @elseif($actie === 'bekijk' && isset($bekijkBericht))

        <div class="contact-form">
        <h3>Formulier Details</h3>
        
        <p><strong>Verzonden door:</strong> {{ $bekijkBericht->sender->username }}</p>
        <p><strong>Verzonden aan:</strong> {{ $bekijkBericht->receiver->username }}</p>
        <p><strong>Datum:</strong> {{ $bekijkBericht->created_at->format('d-m-Y H:i') }}</p>
        <p><strong>Onderwerp:</strong> {{ $bekijkBericht->subject }}</p>
        
        
        <p><strong>Bericht:</strong></p>
        <p>{{ $bekijkBericht->body }}</p>
       

        @if($bekijkBericht->file_path)
            <p><strong>Bijlage:</strong></p>
            
            @php
                $extensie = strtolower(pathinfo($bekijkBericht->file_path, PATHINFO_EXTENSION));
            @endphp

           @if(in_array($extensie, ['jpg', 'jpeg', 'png', 'gif']))
                <a href="{{ asset('storage/' . $bekijkBericht->file_path) }}" target="_blank">
                    <img src="{{ asset('storage/' . $bekijkBericht->file_path) }}" alt="Bijlage" style="max-width: 100%; max-height: 300px; height: auto; object-fit: contain;">
                </a>
                <br>
                <small><a href="{{ asset('storage/' . $bekijkBericht->file_path) }}" target="_blank" style="color: blue;"></a></small>
            
            @elseif($extensie === 'pdf')
                <embed src="{{ asset('storage/' . $bekijkBericht->file_path) }}" type="application/pdf" width="100%" height="600">
            
            @else
                <a href="{{ asset('storage/' . $bekijkBericht->file_path) }}" target="_blank">[ 📎 Download {{ strtoupper($extensie) }} Bestand ]</a>
            @endif
        @endif

        <br><br>
        <a href="/contact"><button type="button" class="contact-btn">Terug naar overzicht</button></a>
</div>
        
    @endif

</div>
@endsection