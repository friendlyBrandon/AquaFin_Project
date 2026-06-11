@extends('layouts.dashboard')

@section('content')

<div class="cart">

<h1>Winkelwagen</h1>

@php
    $cart = session('cart', []);
@endphp

@if(empty($cart))
    <p>Je winkelwagen is momenteel leeg.</p>
@else
<table border="1">
    <tr>
        <th>Foto</th>
        <th>Materiaal</th>
        <th>Aantal</th>
        <th>Actie</th>
    </tr>

    @php $totalItems = 0; @endphp

    @foreach($cart as $id => $item)

        @php
            $echteQty = is_array($item) ? $item['quantity'] : $item;

            $material = $materials[$id] ?? \App\Models\Material::find($id);
            
            $naam = $material ? $material->productname : (is_array($item) ? $item['productname'] : 'Onbekend');
            $imagePath = $material ? $material->image_path : (is_array($item) ? $item['image_path'] : null);
        @endphp

        @if($material || is_array($item))

            @php $totalItems += $echteQty; @endphp

            <tr>
                <td>
                    @if($imagePath)
                        <img src="{{ asset('material_pics/' . $imagePath) }}" alt="{{ str_replace('-', ' ', $naam) }}" width="50">
                    @endif
                </td>
                
                <td>{{ str_replace('-', ' ', $naam) }}</td>
                
                <td>{{ $echteQty }}</td>
                
                <td>
                   <form method="POST" action="/cart/remove/{{ $id }}">
                    @csrf
                    <button type="submit" style="padding: 5px 10px; background-color: #dc3545; color: white; border: none; border-radius: 4px; cursor: pointer;">Verwijderen</button>
                    </form>
                </td>
            </tr>

        @endif

    @endforeach

</table>

<p><b>Totaal aantal items:</b> {{ $totalItems }}</p>

<form method="POST" action="{{ route('orderlog.store') }}">
    @csrf
    <button type="submit" style="padding: 10px 15px; background-color: #28a745; color: white; border: none; border-radius: 5px; font-weight: bold; cursor: pointer;">
        Bestelling Plaatsen
    </button>
</form>

@endif

</div>

@endsection