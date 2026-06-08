@extends('layouts.app') @section('content')
<div class="contact-page">
    <h1>Contacteer een medewerker</h1>

    @if(session('success'))
        <div style="color: green; font-weight: bold; margin-bottom: 20px; padding: 10px; border: 1px solid green;">
            {{ session('success') }}
        </div>
    @endif

    <ul>
        @foreach($medewerkers as $medewerker)
            <li style="margin-bottom: 10px;">
                {{ $medewerker->voornaam }} {{ $medewerker->achternaam }} 
                
                ({{ $medewerker->is_admin ? 'Admin' : 'Stockmedewerker' }})
                
                <button onclick="openForm({{ $medewerker->id }}, '{{ $medewerker->voornaam }} {{ $medewerker->achternaam }}')">
                    ➕ Bericht sturen
                </button>
            </li>
        @endforeach
    </ul>

    <hr>

    <div id="contactFormContainer" style="display: none; margin-top: 20px; border: 1px solid #ccc; padding: 15px;">
        <h2 id="formulierTitel">Nieuw bericht aan...</h2>

        <form method="POST" action="/contact/verstuur" enctype="multipart/form-data">
            @csrf
            
            <input type="hidden" name="receiver_id" id="receiver_id" value="">

            <div>
                <label for="subject">Onderwerp:</label><br>
                <input type="text" name="subject" id="subject" required style="width: 100%; max-width: 400px;">
            </div>
            <br>
            <div>
                <label for="message">Bericht:</label><br>
                <textarea name="message" id="message" rows="5" required style="width: 100%; max-width: 400px;"></textarea>
            </div>
            <br>
            <div>
                <label for="attachment">Bestand uploaden (optioneel):</label><br>
                <input type="file" name="attachment" id="attachment">
            </div>
            <br>
            <button type="submit" style="background-color: blue; color: white; padding: 5px 10px; border: none; cursor: pointer;">Versturen</button>
            <button type="button" onclick="sluitFormulier()" style="background-color: red; color: white; padding: 5px 10px; border: none; cursor: pointer;">Annuleren</button>
        </form>
    </div>
</div>

<script>
    function openForm(id, naam) {
        document.getElementById('contactFormContainer').style.display = 'block';
        
        document.getElementById('formulierTitel').innerText = 'Nieuw bericht aan ' + naam;
        
        document.getElementById('receiver_id').value = id;
        
        document.getElementById('contactFormContainer').scrollIntoView({ behavior: 'smooth' });
    }

    function sluitFormulier() {
        document.getElementById('contactFormContainer').style.display = 'none';
        
        document.getElementById('subject').value = '';
        document.getElementById('message').value = '';
        document.getElementById('attachment').value = '';
    }
</script>
@endsection