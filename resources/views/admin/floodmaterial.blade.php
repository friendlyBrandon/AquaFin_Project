@extends('layouts.dashboard')

@section('content')
<div class='flood-material'>

<h2>Overstromingsmaterialen beheren</h2>

<form method="POST" action="{{ route('flood.store') }}">
    @csrf

    <select name="material_id">
        @foreach($materials as $material)
            <option value="{{ $material->id }}">
                {{ $material->productname }}
            </option>
        @endforeach
    </select>

    <button type="submit">Toevoegen</button>
</form>

<hr>

@foreach($selected as $item)

    <div style="margin-bottom:10px;">

        {{ $item->material->productname }}

        <form method="POST"
              action="{{ route('flood.destroy', $item->id) }}"
              style="display:inline;">
            @csrf
            @method('DELETE')

            <button type="submit">
                Verwijderen
            </button>
        </form>

    </div>
    

@endforeach
@endsection