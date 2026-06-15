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

    <div style="display: flex; gap: 15px; margin-bottom: 20px; flex-wrap: wrap;">
        <div style="flex: 1; min-width: 250px;">
            <select id="categorySelect" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 5px; font-size: 16px; background-color: #f8f9fa; cursor: pointer;">
                <option value="all">-- Alle Categorieën --</option>
                @foreach($materials->pluck('category')->unique() as $cat)
                    <option value="{{ $cat }}">{{ $cat }}</option>
                @endforeach
            </select>
        </div>

        <div style="flex: 2; min-width: 250px;">
            <input type="text" id="searchInput" placeholder="Zoek op naam of productnummer..." style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 5px; font-size: 16px;">
        </div>
    </div>

    <form action="/materials/bestel" method="POST">
        @csrf

        <div style="display: flex; justify-content: flex-end; gap: 15px; margin-bottom: 30px; position: sticky; top: 10px; z-index: 100;">
            
            @if(auth()->check() && auth()->user()->is_admin == 1)
                <button type="button" onclick="openNewMaterialModal()" style="padding: 12px 25px; background-color: #17a2b8; color: white; border: none; border-radius: 5px; font-size: 1.1em; font-weight: bold; cursor: pointer; box-shadow: 0 4px 6px rgba(0,0,0,0.2); transition: background-color 0.3s;">
                    Nieuw Materiaal toevoegen
                </button>
            @endif

            <button type="button" onclick="openCustomOrderModal()" style="padding: 12px 25px; background-color: #6c757d; color: white; border: none; border-radius: 5px; font-size: 1.1em; font-weight: bold; cursor: pointer; box-shadow: 0 4px 6px rgba(0,0,0,0.2); transition: background-color 0.3s;">
                Materiaal op maat aanvragen
            </button>

            <button type="submit" style="padding: 12px 25px; background-color: #28a745; color: white; border: none; border-radius: 5px; font-size: 1.1em; font-weight: bold; cursor: pointer; box-shadow: 0 4px 6px rgba(0,0,0,0.2); transition: background-color 0.3s;">
                Aan winkelmand toevoegen
            </button>

        </div>

        @foreach($materials->groupBy('category') as $categoryName => $items)
            <div class="category-section" data-category="{{ $categoryName }}">
                <h2 style="border-bottom: 2px solid #ccc; padding-bottom: 5px; margin-bottom: 20px; color: #333;">{{ $categoryName }}</h2>
                
                <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-bottom: 50px;">
                    @foreach($items as $material)
                        <div class="product-card" data-name="{{ strtolower($material->productname) }}" data-number="{{ strtolower($material->productnumber) }}" style="width: 250px; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.05); background-color: #fff; display: flex; flex-direction: column;">
                            
                            <div style="height: 150px; background-color: #f4f4f4; border-bottom: 1px solid #ddd; display: flex; align-items: center; justify-content: center; overflow: hidden; position: relative;">
                                @if($material->image_path)
                                    <img src="{{ asset('material_pics/' . $material->image_path) }}" alt="{{ $material->productname }}" style="width: 100%; height: 100%; object-fit: contain; padding: 5px;">
                                @else
                                    <span style="color: #999; font-size: 1.2em;">Geen foto</span>
                                @endif
                                
                                @if(auth()->check() && auth()->user()->is_admin == 1)
                                    
                                    <form action="/materials/delete/{{ $material->id }}" method="POST" onsubmit="return confirm('Weet je zeker dat je {{ $material->productname }} definitief wilt verwijderen?');" style="position: absolute; top: 5px; left: 5px; margin: 0;">
                                        @csrf
                                        <button type="submit" title="Verwijderen" style="background-color: rgba(220, 53, 69, 0.9); color: white; border: none; border-radius: 4px; padding: 5px 10px; font-weight: bold; cursor: pointer; box-shadow: 0 2px 4px rgba(0,0,0,0.2);">
                                            ❌
                                        </button>
                                    </form>

                                    <button type="button" onclick='openEditMaterialModal({{ $material->id }}, @json($material->productname), @json($material->productnumber), @json($material->category), {{ $material->stock }})' style="position: absolute; top: 5px; right: 5px; background-color: rgba(255, 193, 7, 0.9); border: none; border-radius: 4px; padding: 5px 10px; font-weight: bold; cursor: pointer; box-shadow: 0 2px 4px rgba(0,0,0,0.2);">
                                        ✏️ Wijzig
                                    </button>

                                @endif
                                </div>
                            
                            <div style="padding: 15px; display: flex; flex-direction: column; flex-grow: 1;">
                                <h3 style="margin: 0 0 10px 0; font-size: 1.1em; color: #333;">{{ $material->productname }}</h3>
                                <p style="margin: 0 0 5px 0; font-size: 0.9em; color: #666;">Art. code: <strong>{{ $material->productnumber }}</strong></p>
                                <p style="margin: 0 0 15px 0; font-size: 0.9em; color: {{ $material->stock > 0 ? 'green' : 'red' }};">Voorraad: <strong>{{ $material->stock }}</strong></p>
                                
                                <div style="margin-top: auto; display: flex; align-items: center; gap: 10px; background-color: #f8f9fa; padding: 10px; border-radius: 5px; border: 1px solid #eee;">
                                    <span style="font-size: 0.95em; color: #555; font-weight: bold;">Aantal:</span>
                                    
                                    <input type="number" placeholder="0" name="bestelling[{{ $material->id }}]" min="0" max="{{ $material->stock }}" style="flex-grow: 1; padding: 8px; border: 1px solid #ccc; border-radius: 4px; font-size: 1em; text-align: center;" {{ $material->stock == 0 ? 'disabled' : '' }}>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </form> 
</div>

<div id="customOrderModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.6); z-index: 1000; align-items: center; justify-content: center;">
    <div style="background-color: white; padding: 30px; border-radius: 8px; width: 90%; max-width: 500px; box-shadow: 0 5px 15px rgba(0,0,0,0.3);">
        <h3 style="margin-top: 0; border-bottom: 2px solid #eee; padding-bottom: 10px;">Materiaal op maat aanvragen</h3>
        <form method="POST" action="/materials/maatwerk">
            @csrf
            <label style="font-weight: bold; display: block; margin-bottom: 5px; margin-top: 15px;">Kies het basismateriaal:</label>
            <select name="material_id" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                <option value="" disabled selected>Selecteer een artikel</option>
                @foreach($materials as $material)
                    <option value="{{ $material->id }}">{{ $material->productname }} (Art: {{ $material->productnumber }})</option>
                @endforeach
            </select>
            <label style="font-weight: bold; display: block; margin-bottom: 5px; margin-top: 15px;">Aantal stuks:</label>
            <input type="number" name="quantity" min="1" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            <label style="font-weight: bold; display: block; margin-bottom: 5px; margin-top: 15px;">Afmetingen & Eigenschappen:</label>
            <textarea name="dimensions" rows="4" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; resize: vertical;"></textarea>
            <div style="display: flex; gap: 10px; margin-top: 20px; justify-content: flex-end;">
                <button type="button" onclick="closeCustomOrderModal()" style="padding: 10px 15px; background-color: #f8f9fa; border: 1px solid #ccc; color: #333; border-radius: 5px; cursor: pointer; font-weight: bold;">Annuleren</button>
                <button type="submit" style="padding: 10px 15px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;">Aan winkelmand toevoegen</button>
            </div>
        </form>
    </div>
</div>

@if(auth()->check() && auth()->user()->is_admin == 1)
<div id="newMaterialModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.6); z-index: 1000; align-items: center; justify-content: center;">
    <div style="background-color: white; padding: 30px; border-radius: 8px; width: 90%; max-width: 500px; box-shadow: 0 5px 15px rgba(0,0,0,0.3); max-height: 90vh; overflow-y: auto;">
        <h3 style="margin-top: 0; border-bottom: 2px solid #eee; padding-bottom: 10px; color: #17a2b8;">Nieuw Materiaal Aanmaken</h3>
        
        <form method="POST" action="/materials/create" enctype="multipart/form-data">
            @csrf
            <label style="font-weight: bold; display: block; margin-bottom: 5px; margin-top: 15px;">Productnaam:</label>
            <input type="text" name="productname" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">

            <label style="font-weight: bold; display: block; margin-bottom: 5px; margin-top: 15px;">Categorie:</label>
            <select name="category" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; background-color: #f8f9fa; cursor: pointer;">
                <option value="" disabled selected>-- Selecteer een bestaande categorie --</option>
                @foreach($materials->pluck('category')->unique() as $cat)
                    <option value="{{ $cat }}">{{ $cat }}</option>
                @endforeach
            </select>

            <label style="font-weight: bold; display: block; margin-bottom: 5px; margin-top: 15px;">Voorraad (Stock):</label>
            <input type="number" name="stock" min="0" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">

            <label style="font-weight: bold; display: block; margin-bottom: 5px; margin-top: 15px;">Afbeelding (Optioneel):</label>
            <input type="file" name="image" accept="image/*" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; background-color: #f8f9fa;">

            <div style="display: flex; gap: 10px; margin-top: 25px; justify-content: flex-end;">
                <button type="button" onclick="closeNewMaterialModal()" style="padding: 10px 15px; background-color: #f8f9fa; border: 1px solid #ccc; color: #333; border-radius: 5px; cursor: pointer; font-weight: bold;">Annuleren</button>
                <button type="submit" style="padding: 10px 15px; background-color: #17a2b8; color: white; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;">Opslaan</button>
            </div>
        </form>
    </div>
</div>

<div id="editMaterialModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.6); z-index: 1000; align-items: center; justify-content: center;">
    <div style="background-color: white; padding: 30px; border-radius: 8px; width: 90%; max-width: 500px; box-shadow: 0 5px 15px rgba(0,0,0,0.3); max-height: 90vh; overflow-y: auto;">
        <h3 style="margin-top: 0; border-bottom: 2px solid #eee; padding-bottom: 10px; color: #ffc107;">Materiaal Wijzigen</h3>
        
        <form method="POST" action="/materials/update" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="material_id" id="edit_material_id">

            <label style="font-weight: bold; display: block; margin-bottom: 5px; margin-top: 15px;">Productnaam:</label>
            <input type="text" name="productname" id="edit_productname" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">

            <label style="font-weight: bold; display: block; margin-bottom: 5px; margin-top: 15px;">Productnummer / Art. code (Kan niet gewijzigd worden):</label>
            <input type="text" name="productnumber" id="edit_productnumber" readonly style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; background-color: #e9ecef; color: #555; cursor: not-allowed;">

            <label style="font-weight: bold; display: block; margin-bottom: 5px; margin-top: 15px;">Categorie:</label>
            <select name="category" id="edit_category" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; background-color: #f8f9fa; cursor: pointer;">
                @foreach($materials->pluck('category')->unique() as $cat)
                    <option value="{{ $cat }}">{{ $cat }}</option>
                @endforeach
            </select>

            <label style="font-weight: bold; display: block; margin-bottom: 5px; margin-top: 15px;">Voorraad (Stock):</label>
            <input type="number" name="stock" id="edit_stock" min="0" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">

            <label style="font-weight: bold; display: block; margin-bottom: 5px; margin-top: 15px;">Nieuwe Afbeelding (Laat leeg om huidige te behouden):</label>
            <input type="file" name="image" accept="image/*" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; background-color: #f8f9fa;">

            <div style="display: flex; gap: 10px; margin-top: 25px; justify-content: flex-end;">
                <button type="button" onclick="closeEditMaterialModal()" style="padding: 10px 15px; background-color: #f8f9fa; border: 1px solid #ccc; color: #333; border-radius: 5px; cursor: pointer; font-weight: bold;">Annuleren</button>
                <button type="submit" style="padding: 10px 15px; background-color: #ffc107; color: #333; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;">Wijzigingen Opslaan</button>
            </div>
        </form>
    </div>
</div>
@endif

<script>
const searchInput = document.getElementById('searchInput');
const categorySelect = document.getElementById('categorySelect');
const categorySections = document.querySelectorAll('.category-section');

function fuzzyMatch(query, target) {
    if (query.length === 0) return true;
    if (target.includes(query)) return true;
    if (query.length < 2) return false;

    let maxErrors = Math.floor(query.length / 2);
    for (let i = 0; i <= target.length - query.length; i++) {
        let errors = 0;
        for (let j = 0; j < query.length; j++) {
            if (target[i + j] !== query[j]) {
                errors++;
            }
            if (errors > maxErrors) break;
        }
        if (errors <= maxErrors) return true;
    }
    return false;
}

function matchMultipleTerms(query, target) {
    let terms = query.split(' ').filter(w => w.length > 0);
    if (terms.length === 0) return true;
    for (let term of terms) {
        if (!fuzzyMatch(term, target)) {
            return false;
        }
    }
    return true;
}

function filterMaterials() {
    let queryText = searchInput.value.toLowerCase().trim();
    let selectedCategory = categorySelect.value;

    categorySections.forEach(function(section) {
        let sectionCategory = section.getAttribute('data-category');
        let categoryMatches = (selectedCategory === 'all' || selectedCategory === sectionCategory);
        let cards = section.querySelectorAll('.product-card');
        let hasVisibleCards = false;

        cards.forEach(function(card) {
            let name = card.getAttribute('data-name');
            let number = card.getAttribute('data-number');
            let isMatch = matchMultipleTerms(queryText, name) || number.includes(queryText);

            if (categoryMatches && isMatch) {
                card.style.display = "flex";
                hasVisibleCards = true;
            } else {
                card.style.display = "none";
            }
        });

        if (categoryMatches && hasVisibleCards) {
            section.style.display = "block";
        } else {
            section.style.display = "none";
        }
    });
}

searchInput.addEventListener('keyup', filterMaterials);
categorySelect.addEventListener('change', filterMaterials);
filterMaterials();

const modal = document.getElementById('customOrderModal');
function openCustomOrderModal() { modal.style.display = 'flex'; }
function closeCustomOrderModal() { modal.style.display = 'none'; }

@if(auth()->check() && auth()->user()->is_admin == 1)
    const newMaterialModal = document.getElementById('newMaterialModal');
    const editMaterialModal = document.getElementById('editMaterialModal');

    function openNewMaterialModal() {
        newMaterialModal.style.display = 'flex';
    }

    function closeNewMaterialModal() {
        newMaterialModal.style.display = 'none';
    }

    function openEditMaterialModal(id, name, number, category, stock) {
        document.getElementById('edit_material_id').value = id;
        document.getElementById('edit_productname').value = name;
        document.getElementById('edit_productnumber').value = number;
        document.getElementById('edit_category').value = category;
        document.getElementById('edit_stock').value = stock;
        
        editMaterialModal.style.display = 'flex';
    }

    function closeEditMaterialModal() {
        editMaterialModal.style.display = 'none';
    }
@endif
</script>
@endsection