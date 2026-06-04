@extends('layouts.dashboard')

@section('content')

<div class="materials">
@if(session('Success'))
    <p style="color: green; font-weight: bold;">
        {{ session('Success') }}
    </p>
@endif

<input type="text" id="search" placeholder="Search name or productnumber...">

<table border="1" id="materiaalTabel">
    <thead>
        <tr>
            <th>Name</th>
            <th>Productnumber</th>
            <th>Stock</th>
            <th>Order</th>
        </tr>
    </thead>

    <tbody>
        @foreach($materials as $material)
        <tr class="material-row">
            <td class="prod-number">{{ $material->product_number }}</td>
            <td class="mat-name">{{ $material->name }}</td>
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

        if (productNumber.includes(filter) || name.includes(filter)) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
});
</script>
</div>
@endsection