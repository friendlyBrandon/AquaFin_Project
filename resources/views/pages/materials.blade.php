@extends('layouts.dashboard')

@section('content')

<div class="materials">
@if(session('Success'))
    <p style="color: green; font-weight: bold;">
        {{ session('Success') }}
    </p>
@endif


<input type="text" id="search" placeholder="Zoek op naam of productnummer...">
        <table border="1" id="materiaalTabel">
        <thead>
            <tr>
                <th>Productnaam</th>                
                <th>Productnummer</th>
                <th>Categorie</th>
                <th>Voorraad</th>
                <th>Bestelling</th>
            </tr>
        </thead>
        <tbody>
            @foreach($materials as $material)
            <tr class="material-row">
                <td class="mat-name">{{ $material->productname }}</td>
                <td class="prod-number">{{ $material->productnumber }}</td>
                <td class="cat-name">{{ $material->category }}</td>
                <td>{{ $material->stock }}</td>
                <td>
                    <form action="/materials/{{ $material->id }}" method="POST">
                        @csrf
                        <input type="hidden" name="material_id" value="{{ $material->id }}">
                        <input type="number" name="quantity" min="1" max="{{ $material->stock }}">
                        <button type="submit">Order</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

<script>
document.getElementById('search').addEventListener('keyup', function() {

    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll('.material-row');

    rows.forEach(function(row) {
        let productNumber = row.querySelector('.prod-number').textContent.toLowerCase();
        let name = row.querySelector('.mat-name').textContent.toLowerCase();
        let category = row.querySelector('.cat-name').textContent.toLowerCase();

        if (productNumber.includes(filter) || name.includes(filter) || category.includes(filter)) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
});
</script>
</div>
@endsection