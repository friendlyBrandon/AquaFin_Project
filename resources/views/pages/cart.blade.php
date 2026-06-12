@extends('layouts.dashboard')

@section('content')

<div class="cart">

    <h1>Winkelwagen</h1>

    @if(session('success'))
        <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
            <strong>Succes!</strong> {{ session('success') }}
        </div>
    @endif
    @php
        $cart = session('cart', []);
    @endphp

    @if(empty($cart))
        <p>Je winkelwagen is momenteel leeg.</p>
    @else
    <table border="1" style="width: 100%; text-align: left; border-collapse: collapse;">
        <tr style="background-color: #f8f9fa;">
            <th style="padding: 10px;">Foto</th>
            <th style="padding: 10px;">Materiaal</th>
            <th style="padding: 10px;">Dimensies / Eigenschappen</th> <th style="padding: 10px;">Aantal</th>
            <th style="padding: 10px;">Actie</th>
        </tr>

        @php $totalItems = 0; @endphp

        @foreach($cart as $id => $item)

        @php
            $echteQty = is_array($item) ? $item['quantity'] : $item;

            $realId = is_array($item) && isset($item['material_id']) ? $item['material_id'] : $id;

            $material = $materials[$realId] ?? \App\Models\Material::find($realId);
            
            $naam = $material ? $material->productname : (is_array($item) ? ($item['productname'] ?? 'Verwijderd Artikel') : 'Onbekend');
            $imagePath = $material ? $material->image_path : (is_array($item) ? ($item['image_path'] ?? null) : null);
        @endphp

        @if($material || is_array($item))

            @php $totalItems += $echteQty; @endphp

            <tr style="border-bottom: 1px solid #ddd;">
                <td style="padding: 10px;">
                    @if($imagePath)
                        <img src="{{ asset('material_pics/' . $imagePath) }}" alt="{{ str_replace('-', ' ', $naam) }}" width="50">
                    @endif
                </td>
                
                <td style="padding: 10px;">
                    <span style="font-weight: bold; font-size: 1.05em;">{{ str_replace('-', ' ', $naam) }}</span>
                </td>

                <td style="padding: 10px;">
                    @if(is_array($item) && !empty($item['dimensions']))
                        <span style="color: #007bff;">{!! nl2br(e($item['dimensions'])) !!}</span>
                    @else
                        <span style="color: #999; font-style: italic;">Standaard</span>
                    @endif
                </td>
                <td style="padding: 10px;">
                    <form method="POST" action="{{ route('cart.update', $id) }}" style="display: flex; gap: 5px; align-items: center;">
                        @csrf
                        <input type="number" name="quantity" value="{{ is_array($item) ? $item['quantity'] : $item }}" min="1" style="width: 70px; padding: 5px; border: 1px solid #ccc; border-radius: 4px;">
                        <button type="submit" style="padding: 5px 10px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">
                            Wijzigen
                        </button>
                    </form>
                </td>
                
                <td style="padding: 10px;">
                    <form method="POST" action="/cart/remove/{{ $id }}">
                        @csrf
                        <button type="submit" style="padding: 5px 10px; background-color: #dc3545; color: white; border: none; border-radius: 4px; cursor: pointer;">Verwijderen</button>
                    </form>
                </td>
            </tr>

        @endif

    @endforeach

    </table>

    <p style="margin-top: 20px; font-size: 1.1em;"><b>Totaal aantal items:</b> {{ $totalItems }}</p>

    <form method="POST" action="{{ route('orderlog.store') }}">
        @csrf
        <button type="submit" style="padding: 10px 15px; background-color: #28a745; color: white; border: none; border-radius: 5px; font-weight: bold; cursor: pointer;">
            Bestelling Plaatsen
        </button>
    </form>

    @endif

</div>

@endsection