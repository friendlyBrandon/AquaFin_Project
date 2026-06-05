@extends('layouts.dashboard')

@section('content')

<div class="cart">

<h1>🛒 Shopping Cart</h1>

@php
    $cart = session('cart', []);
@endphp

@if(empty($cart))
    <p>No materials in the cart.</p>
@else

<table border="1">
    <tr>
        <th>Material</th>
        <th>Quantity</th>
        <th>Action</th>
    </tr>

    @php $totalItems = 0; @endphp

    @foreach($cart as $id => $qty)

        @php
            $material = \App\Models\Material::find($id);
        @endphp

        @if($material)

        @php $totalItems += $qty; @endphp

        <tr>
            <td>{{ $material->name }}</td>
            <td>{{ $qty }}</td>
            <td>
               <form method="POST" action="/cart/remove/{{ $id }}">
                @csrf
                <button type="submit">Remove</button>
                </form>
            </td>
        </tr>

        @endif

    @endforeach

</table>

<p><b>Total items:</b> {{ $totalItems }}</p>
 <form method="Post" action="/cart/checkout/{{ $id }}">
    @csrf
    <button type="checkout">Checkout</button>
 </form>

@endif

</div>

@endsection