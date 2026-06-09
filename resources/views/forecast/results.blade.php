<h1>Neerslag voorspelling</h1>

<table border="1">
    <tr>
        <th>Jaar</th>
        <th>Maand</th>
        <th>Neerslag</th>
    </tr>

    @foreach ($processedForecast as $item)
        <tr>
            <td>{{ $item['year'] }}</td>
            <td>{{ $item['month'] }}</td>
            <td>{{ $item['rainfall'] }}</td>
        </tr>
    @endforeach
</table>