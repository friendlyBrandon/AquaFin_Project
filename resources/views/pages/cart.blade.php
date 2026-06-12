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
    @endphp

    @if(empty($cart))

        <p>Je winkelwagen is momenteel leeg.</p>

    @else

        @if(!$isMobile)

            {{-- ================= DESKTOP ================= --}}

            <table border="1" style="width: 100%; text-align: left; border-collapse: collapse;">
                <tr style="background-color: #f8f9fa;">
                    <th style="padding: 10px;">Foto</th>
                    <th style="padding: 10px;">Materiaal</th>
                    <th style="padding: 10px;">Dimensies / Eigenschappen</th>
                    <th style="padding: 10px;">Aantal</th>
                    <th style="padding: 10px;">Actie</th>
                </tr>

                @php $totalItems = 0; @endphp

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
                    @endphp

                    @if($material || is_array($item))

                        @php $totalItems += $echteQty; @endphp

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
                                <form method="POST" action="{{ route('cart.update', $id) }}">
                                    @csrf
                                    <input type="number" name="quantity" value="{{ $echteQty }}" min="1">
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

            {{-- ================= MOBILE ================= --}}

            <div class="mobile-cart">

                @php $totalItems = 0; @endphp

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
                    @endphp

                    @if($material || is_array($item))

                        @php $totalItems += $echteQty; @endphp

                        <div class="mobile-cart-item">

                            @if($imagePath)
                                <img src="{{ asset('material_pics/' . $imagePath) }}" class="mobile-cart-image">
                            @endif

                            <h3>{{ str_replace('-', ' ', $naam) }}</h3>

                            @if(is_array($item) && !empty($item['dimensions']))
                                <p class="mobile-dimensions">
                                    {!! nl2br(e($item['dimensions'])) !!}
                                </p>
                            @endif

                            <p><strong>Aantal:</strong> {{ $echteQty }}</p>

                            <div class="mobile-actions">

                                <form method="POST" action="{{ route('cart.update', $id) }}">
                                    @csrf
                                    <input type="number" name="quantity" value="{{ $echteQty }}" min="1">
                                    <button type="submit">Wijzigen</button>
                                </form>

                                <form method="POST" action="/cart/remove/{{ $id }}">
                                    @csrf
                                    <button type="submit">Verwijderen</button>
                                </form>

                            </div>

                        </div>

                    @endif

                @endforeach

            </div>

        @endif

        {{-- ================= TOTAAL + BESTELLING ================= --}}

        <p style="margin-top: 20px;">
            <b>Totaal aantal items:</b> {{ $totalItems }}
        </p>

        <form method="POST" action="{{ route('orderlog.store') }}">
            @csrf
            <button type="submit"class="order-btn">
                Bestelling Plaatsen
            </button>
        </form>

    @endif

</div>

@endsection