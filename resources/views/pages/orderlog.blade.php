@extends('layouts.dashboard')

@section('content')

<div style="padding: 20px;">

    <h1>Besteloverzicht</h1>

    @if(session('success'))
        <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
            <strong>Succes!</strong> {{ session('success') }}
        </div>
    @endif

    @if($orders->isEmpty())
        <p>Er zijn momenteel geen bestellingen.</p>
    @else
        @foreach($orders as $orderId => $items)
            @php
                $eersteItem = $items->first();
                $status = $eersteItem->status;
                $datum = $eersteItem->created_at->format('d-m-Y H:i');
                
                $statusKleur = 'orange'; // Standaard voor 'pending'
                if($status == 'validated') $statusKleur = 'green';
                if($status == 'refused') $statusKleur = 'red';
            @endphp

            <div style="background-color: #fff; border: 1px solid #ddd; border-radius: 8px; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                
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
                        @foreach($items as $item)
                            <tr style="border-bottom: 1px solid #eee;">
                                <td style="padding: 8px 0; font-weight: bold; width: 70%;">{{ $item->productname }}</td>
                                <td style="padding: 8px 0; color: #555;">{{ $item->quantity }} stuks</td>
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

@endsection