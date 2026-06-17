@php
$isMobile = preg_match('/Android|iPhone|iPad/i', request()->userAgent());
@endphp

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
        
        $totalItems = 0;
        $totaalGewicht = 0;

        $userProvincie = auth()->check() ? auth()->user()->provincie : 'Onbekend';
    @endphp    

    @if(empty($cart))

        <p>Je winkelwagen is momenteel leeg.</p>

    @else

        @if(!$isMobile)

            <table border="1" style="width: 100%; text-align: left; border-collapse: collapse;">
                <tr style="background-color: #f8f9fa;">
                    <th style="padding: 10px;">Foto</th>
                    <th style="padding: 10px;">Materiaal</th>
                    <th style="padding: 10px;">Afmetingen / Eigenschappen</th>
                    <th style="padding: 10px;">Gewicht / st</th>
                    <th style="padding: 10px;">Subtotaal Gewicht</th>
                    <th style="padding: 10px;">Aantal</th>
                    <th style="padding: 10px;">Actie</th>
                </tr>

                @foreach($cart as $id => $item)

                    @php
                        $echteQty = is_array($item) ? $item['quantity'] : $item;

                        $realId = is_array($item) && isset($item['material_id'])
                            ? $item['material_id']
                            : $id;

                        $material = $materials[$realId] ?? \App\Models\Material::find($realId);

                        $naam = $material
                            ? $material->productname
                            : (is_array($item)
                                ? ($item['productname'] ?? 'Verwijderd Artikel')
                                : 'Onbekend');

                        $imagePath = $material
                            ? $material->image_path
                            : (is_array($item)
                                ? ($item['image_path'] ?? null)
                                : null);
                        
                        $stukGewicht = $material ? ($material->weight ?? 0) : 0;
                        $rijGewicht = $stukGewicht * $echteQty;
                    @endphp

                    @if($material || is_array($item))

                        @php 
                            $totalItems += $echteQty; 
                            $totaalGewicht += $rijGewicht;
                        @endphp

                        <tr style="border-bottom: 1px solid #ddd;">
                            <td style="padding: 10px;">
                                @if($imagePath)
                                    <img src="{{ asset('material_pics/' . $imagePath) }}" width="50">
                                @endif
                            </td>

                            <td style="padding: 10px;">
                                <strong>{{ str_replace('-', ' ', $naam) }}</strong>
                            </td>

                            <td style="padding: 10px;">
                                @if(is_array($item) && !empty($item['dimensions']))
                                    <span style="color: #007bff;">
                                        {!! nl2br(e($item['dimensions'])) !!}
                                    </span>
                                @else
                                    <span style="color: #999;">Standaard</span>
                                @endif
                            </td>

                            <td style="padding: 10px;">
                                {{ $stukGewicht > 0 ? number_format($stukGewicht, 2) . ' kg' : '-' }}
                            </td>

                            <td style="padding: 10px; font-weight: bold; color: #555;">
                                {{ $rijGewicht > 0 ? number_format($rijGewicht, 2) . ' kg' : '-' }}
                            </td>

                            <td style="padding: 10px;">
                                <form method="POST" action="{{ route('cart.update', $id) }}" style="display:flex; gap: 5px;">
                                    @csrf
                                    <input type="number" name="quantity" value="{{ $echteQty }}" min="1" style="width: 60px;">
                                    <button type="submit">Wijzigen</button>
                                </form>
                            </td>

                            <td style="padding: 10px;">
                                <form method="POST" action="/cart/remove/{{ $id }}">
                                    @csrf
                                    <button type="submit">Verwijderen</button>
                                </form>
                            </td>
                        </tr>

                    @endif

                @endforeach

            </table>

        @else

            <div class="mobile-cart">

                @foreach($cart as $id => $item)

                    @php
                        $echteQty = is_array($item) ? $item['quantity'] : $item;

                        $realId = is_array($item) && isset($item['material_id'])
                            ? $item['material_id']
                            : $id;

                        $material = $materials[$realId] ?? \App\Models\Material::find($realId);

                        $naam = $material
                            ? $material->productname
                            : (is_array($item)
                                ? ($item['productname'] ?? 'Verwijderd Artikel')
                                : 'Onbekend');

                        $imagePath = $material
                            ? $material->image_path
                            : (is_array($item)
                                ? ($item['image_path'] ?? null)
                                : null);

                        $stukGewicht = $material ? ($material->weight ?? 0) : 0;
                        $rijGewicht = $stukGewicht * $echteQty;
                    @endphp

                    @if($material || is_array($item))

                        @php 
                            $totalItems += $echteQty; 
                            $totaalGewicht += $rijGewicht;
                        @endphp

                        <div class="mobile-cart-item" style="border: 1px solid #ddd; padding: 15px; margin-bottom: 10px; border-radius: 5px;">

                            @if($imagePath)
                                <img src="{{ asset('material_pics/' . $imagePath) }}" class="mobile-cart-image" style="max-width: 100px; display: block; margin-bottom: 10px;">
                            @endif

                            <h3 style="margin-top: 0;">{{ str_replace('-', ' ', $naam) }}</h3>
                            
                            @if($stukGewicht > 0)
                                <p style="font-size: 0.85em; color: #666; margin: 2px 0;">
                                    Gewicht per stuk: {{ $stukGewicht }} kg<br>
                                    <strong>Subtotaal gewicht: {{ number_format($rijGewicht, 2) }} kg</strong>
                                </p>
                            @endif

                            @if(is_array($item) && !empty($item['dimensions']))
                                <p class="mobile-dimensions" style="color: #007bff; margin: 5px 0;">
                                    {!! nl2br(e($item['dimensions'])) !!}
                                </p>
                            @endif

                            <p><strong>Aantal:</strong> {{ $echteQty }}</p>

                            <div class="mobile-actions" style="display: flex; gap: 10px; margin-top: 10px;">

                                <form method="POST" action="{{ route('cart.update', $id) }}">
                                    @csrf
                                    <input type="number" name="quantity" value="{{ $echteQty }}" min="1" style="width: 50px;">
                                    <button type="submit">Wijzigen</button>
                                </form>

                                <form method="POST" action="/cart/remove/{{ $id }}">
                                    @csrf
                                    <button type="submit" style="color: red;">Verwijderen</button>
                                </form>

                            </div>

                        </div>

                    @endif

                @endforeach

            </div>

        @endif

        @php
            if ($totaalGewicht > 1000) {
                $levertijd = "5 werkdagen (Vrachtwagen Transport)";
                $leverKleur = "#dc3545"; // Rood
                $leverAchtergrond = "#f8d7da";
            } elseif ($totaalGewicht > 100) {
                $levertijd = "Meer dan 2 werkdagen (Zwaar Transport)";
                $leverKleur = "#856404"; // Donkergeel/Oranje
                $leverAchtergrond = "#fff3cd";
            } else {
                $levertijd = "1 tot 2 werkdagen (Standaard bestelwagen)";
                $leverKleur = "#28a745"; // Groen
                $leverAchtergrond = "#d4edda";
            }
        @endphp

        <div style="margin-top: 30px; padding: 25px; background-color: #fff; border: 1px solid #ddd; border-radius: 8px; max-width: 500px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
            <h3 style="margin-top: 0; border-bottom: 2px solid #eee; padding-bottom: 10px;">Overzicht Bestelling</h3>
            
            <p style="font-size: 1.1em;"><b>Totaal aantal items:</b> {{ $totalItems }}</p>
            <p style="font-size: 1.1em;"><b>Totale massa:</b> {{ number_format($totaalGewicht, 2) }} kg</p>
            
            <div style="background-color: {{ $leverAchtergrond }}; padding: 15px; border-radius: 6px; border: 1px solid {{ $leverKleur }}; margin-top: 20px; margin-bottom: 20px;">
                <p style="margin: 0 0 5px 0; font-size: 0.95em; color: #555; font-weight: bold;">Leveringstijd:</p>
                <p style="margin: 0; font-size: 1.1em; color: {{ $leverKleur }}; font-weight: bold;">
                    {{ $levertijd }}
                </p>
            </div>

            <form method="POST" action="{{ route('orderlog.store') }}">
                @csrf
                
                <div style="background-color: #f8f9fa; padding: 15px; border: 1px solid #ddd; border-radius: 6px; margin-bottom: 20px;">
                    <p style="margin: 0 0 8px 0; font-size: 1em; color: #333;">
                        <b>Gekoppelde Leverplaats:</b> Depot {{ $userProvincie }}
                    </p>
                    <p style="margin: 0; font-size: 0.9em; color: #555;">
                        Regio: <strong style="color: #007bff;">{{ $userProvincie }}</strong>
                    </p>

                    <input type="hidden" name="provincie" value="{{ $userProvincie }}">
                </div>

                <button type="submit" class="order-btn" style="width: 100%; padding: 15px; background-color: #28a745; color: white; border: none; border-radius: 5px; font-size: 1.1em; font-weight: bold; cursor: pointer;">
                    Bestelling Plaatsen
                </button>
            </form>
        </div>

    @endif

</div>

@endsection