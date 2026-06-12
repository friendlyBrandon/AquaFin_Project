@extends('layouts.dashboard')

@section('content')

<div class="materials">
    @if(session('Success'))
        <p style="color: green; font-weight: bold; padding: 10px; border: 1px solid green; background-color: #e6ffe6; border-radius: 5px;">
            {{ session('Success') }}
        </p>
    @endif
    @if($errors->any())
        <p style="color: red; font-weight: bold; padding: 10px; border: 1px solid red; background-color: #ffe6e6; border-radius: 5px;">
            {{ $errors->first() }}
        </p>
    @endif

    <div style="display: flex; gap: 15px; margin-bottom: 40px; flex-wrap: wrap;">
        
        <div style="flex: 1; min-width: 250px;">
            <select id="categorySelect" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 5px; font-size: 16px; background-color: #f8f9fa; cursor: pointer;">
                <option value="all">-- Alle Categorieën --</option>
                @foreach($materials->pluck('category')->unique() as $cat)
                    <option value="{{ $cat }}">{{ $cat }}</option>
                @endforeach
            </select>
        </div>

        <div style="flex: 2; min-width: 250px;">
            <input type="text" id="search" placeholder="Zoek op naam of productnummer..." style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 5px; font-size: 16px;">
        </div>

    </div>

    <form action="/materials/bestel" method="POST">
        @csrf

        @foreach($materials->groupBy('category') as $categorieNaam => $artikelen)
            
            <div class="categorie-sectie" data-category="{{ $categorieNaam }}">
                
                <h2 style="border-bottom: 2px solid #ccc; padding-bottom: 5px; margin-bottom: 20px; color: #333;">{{ $categorieNaam }}</h2>
                
                <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-bottom: 50px;">
                    
                    @foreach($artikelen as $material)
                        <div class="product-card" data-name="{{ strtolower($material->productname) }}" data-number="{{ strtolower($material->productnumber) }}" style="width: 250px; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.05); background-color: #fff; display: flex; flex-direction: column;">
                            
                            <div style="height: 150px; background-color: #f4f4f4; border-bottom: 1px solid #ddd; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                                @if($material->image_path)
                                    <img src="{{ asset('material_pics/' . $material->image_path) }}" alt="{{ $material->productname }}" style="width: 100%; height: 100%; object-fit: contain; padding: 5px;">
                                @else
                                    <span style="color: #999; font-size: 1.2em;">📷 Geen foto</span>
                                @endif
                            </div>
                            
                            <div style="padding: 15px; display: flex; flex-direction: column; flex-grow: 1;">
                                
                                <h3 style="margin: 0 0 10px 0; font-size: 1.1em; color: #333;">{{ $material->productname }}</h3>
                                
                                <p style="margin: 0 0 5px 0; font-size: 0.9em; color: #666;">
                                    Art. code: <strong>{{ $material->productnumber }}</strong>
                                </p>
                                
                                <p style="margin: 0 0 15px 0; font-size: 0.9em; color: {{ $material->stock > 0 ? 'green' : 'red' }};">
                                    Voorraad: <strong>{{ $material->stock }}</strong>
                                </p>
                                
                                <div style="margin-top: auto; display: flex; gap: 10px;">
                                    
                                    <input type="number" placeholder="0" name="bestelling[{{ $material->id }}]" min="0" max="{{ $material->stock }}" style="width: 60px; padding: 5px; border: 1px solid #ccc; border-radius: 4px;" {{ $material->stock == 0 ? 'disabled' : '' }}>
                                    
                                    <button type="submit" style="flex-grow: 1; padding: 8px; background-color: {{ $material->stock == 0 ? '#ccc' : '#0056b3' }}; color: white; border: none; border-radius: 4px; cursor: pointer;" {{ $material->stock == 0 ? 'disabled' : '' }}>
                                        Order
                                    </button>
                                </div>

                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        @endforeach

    </form> </div>

<script>
const searchInput = document.getElementById('search');
const categorySelect = document.getElementById('categorySelect');
const categorieSecties = document.querySelectorAll('.categorie-sectie');

function filterMaterialen() {
    let filterTekst = searchInput.value.toLowerCase();
    let gekozenCategorie = categorySelect.value;

    categorieSecties.forEach(function(sectie) {
        let sectieCategorie = sectie.getAttribute('data-category');
        
        let categorieIsGekozen = (gekozenCategorie === 'all' || gekozenCategorie === sectieCategorie);

        let cards = sectie.querySelectorAll('.product-card');
        let heeftZichtbareCards = false;

        cards.forEach(function(card) {
            let name = card.getAttribute('data-name');
            let number = card.getAttribute('data-number');

            let zoekMatch = name.includes(filterTekst) || number.includes(filterTekst);

            if (categorieIsGekozen && zoekMatch) {
                card.style.display = "flex";
                heeftZichtbareCards = true;
            } else {
                card.style.display = "none";
            }
        });

        if (categorieIsGekozen && heeftZichtbareCards) {
            sectie.style.display = "block";
        } else {
            sectie.style.display = "none";
        }
    });
}

searchInput.addEventListener('keyup', filterMaterialen);
categorySelect.addEventListener('change', filterMaterialen);

filterMaterialen();
</script>

@endsection