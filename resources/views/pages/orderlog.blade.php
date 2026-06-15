@extends('layouts.dashboard')

@section('content')

<div style="padding: 20px;">

    <h1>Besteloverzicht</h1>

    @if(session('success'))
        <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
            <strong>Succes!</strong> {{ session('success') }}
        </div>
    @endif

    <div style="display: flex; gap: 15px; margin-bottom: 30px; flex-wrap: wrap; background-color: #f8f9fa; padding: 15px; border-radius: 8px; border: 1px solid #ddd;">
        
        <div style="flex: 2; min-width: 250px;">
            <label for="searchOrder" style="font-weight: bold; font-size: 0.9em; color: #555; display: block; margin-bottom: 5px;">Zoeken:</label>
            <input type="text" id="searchOrder" placeholder="Zoek op productnaam of de 4 cijfers van het bestelnummer..." style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; font-size: 1em;">
        </div>

        <div style="flex: 1; min-width: 200px;">
            <label for="searchDate" style="font-weight: bold; font-size: 0.9em; color: #555; display: block; margin-bottom: 5px;">Kies een datum:</label>
            <div style="display: flex; gap: 5px;">
                <input type="date" id="searchDate" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; font-size: 1em; cursor: pointer;">
                <button type="button" id="clearDate" style="padding: 10px 15px; background-color: #6c757d; color: white; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;" title="Wis datum">
                    ✖
                </button>
            </div>
        </div>

    </div>
    
    @if($orders->isEmpty())
        <p>Er zijn momenteel geen bestellingen.</p>
    @else
        @foreach($orders as $orderId => $items)
            @php
                $eersteItem = $items->first();
                $status = $eersteItem->status;
                $datum = $eersteItem->created_at->format('d-m-Y H:i');
                
                $zoekDatum = $eersteItem->created_at->format('Y-m-d');
                $laatsteVierCijfers = substr($orderId, -4);
                $alleProductNamen = strtolower($items->pluck('productname')->implode(' '));
                
                $statusKleur = 'orange'; // Standaard voor 'pending'
                if($status == 'validated') $statusKleur = 'green';
                if($status == 'refused') $statusKleur = 'red';
            @endphp

            <div class="order-card" data-ordernumber="{{ $laatsteVierCijfers }}" data-products="{{ $alleProductNamen }}" data-date="{{ $zoekDatum }}" style="background-color: #fff; border: 1px solid #ddd; border-radius: 8px; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                
                <div style="background-color: #f8f9fa; padding: 15px; border-bottom: 1px solid #ddd; display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <h3 style="margin: 0; color: #333; font-size: 1.2em;">
                            Bestelnummer: <span style="color: #007bff;">{{ $orderId }}</span>
                        </h3>
                        <small style="color: #666;">Geplaatst op: {{ $datum }}</small>
                    </div>
                    <div>
                        <span style="background-color: {{ $statusKleur }}; color: white; padding: 5px 10px; border-radius: 4px; font-weight: bold; text-transform: uppercase; font-size: 0.9em;">
                            {{ $status }}
                        </span>
                    </div>
                </div>

                <div style="padding: 15px;">
                    <table style="width: 100%; border-collapse: collapse; text-align: left;">
                        <tr>
                            <th style="padding: 8px 5px; border-bottom: 2px solid #eee; color: #555;">Product</th>
                            <th style="padding: 8px 5px; border-bottom: 2px solid #eee; color: #555;">Afmetingen / Eigenschappen</th>
                            <th style="padding: 8px 5px; border-bottom: 2px solid #eee; color: #555; text-align: right;">Aantal</th>
                        </tr>
                        @foreach($items as $item)
                            <tr style="border-bottom: 1px solid #f4f4f4;">
                                
                                <td style="padding: 10px 5px; width: 40%; vertical-align: top;">
                                    <span style="font-weight: bold;">{{ $item->productname }}</span>
                                </td>
                                
                                <td style="padding: 10px 5px; width: 40%; vertical-align: top;">
                                    @if($item->dimensions)
                                        <span style="color: #007bff;">{!! nl2br(e($item->dimensions)) !!}</span>
                                    @else
                                        <span style="color: #999; font-style: italic;">Standaard</span>
                                    @endif
                                </td>

                                <td style="padding: 10px 5px; color: #555; vertical-align: top; text-align: right; width: 20%;">
                                    {{ $item->quantity }} stuks
                                </td>

                            </tr>
                        @endforeach
                    </table>
                    </div>

                @if((auth()->user()->is_admin == 1 || auth()->user()->is_stockMedewerker == 1) && $status == 'pending')
                    <div style="padding: 15px; background-color: #fafafa; border-top: 1px solid #eee; display: flex; gap: 10px;">
                        
                        <form method="POST" action="/orderlog/{{ $orderId }}/status/accepted">
                            @csrf
                            <button type="submit" style="padding: 8px 15px; background-color: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">
                                ✔ Accepteren
                            </button>
                        </form>

                        <form method="POST" action="/orderlog/{{ $orderId }}/status/rejected">
                            @csrf
                            <button type="submit" style="padding: 8px 15px; background-color: #dc3545; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">
                                ✖ Weigeren
                            </button>
                        </form>

                    </div>
                @endif

            </div>
        @endforeach
    @endif

</div>

<script>
    const searchOrder = document.getElementById('searchOrder');
    const searchDate = document.getElementById('searchDate');
    const clearDateBtn = document.getElementById('clearDate');
    const orderCards = document.querySelectorAll('.order-card');

    function filterOrders() {
        let textFilter = searchOrder.value.toLowerCase().trim();
        let dateFilter = searchDate.value;

        orderCards.forEach(card => {
            let orderNumber = card.getAttribute('data-ordernumber');
            let products = card.getAttribute('data-products');
            let orderDate = card.getAttribute('data-date');

            let matchesText = false;
            if (textFilter === "") {
                matchesText = true;
            } else if (orderNumber.includes(textFilter) || products.includes(textFilter)) {
                matchesText = true;
            }

            let matchesDate = false;
            if (dateFilter === "") {
                matchesDate = true;
            } else if (dateFilter === orderDate) {
                matchesDate = true;
            }

            if (matchesText && matchesDate) {
                card.style.display = "block";
            } else {
                card.style.display = "none";
            }
        });
    }

    searchOrder.addEventListener('keyup', filterOrders);
    searchDate.addEventListener('change', filterOrders);

    clearDateBtn.addEventListener('click', function() {
        searchDate.value = ""; 
        filterOrders();        
    });
</script>

@endsection