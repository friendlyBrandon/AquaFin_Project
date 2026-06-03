<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materiaal</title>
</head>
<body>
        <table border="1">
            <tr>
                <th>Naam</th>
                <th>Productnummer</th>
                <th>Voorraad</th>
                <th>Bestellen</th>
            </tr>
            
            @foreach($materials as $material)
            <tr>
                <td>{{ $material->name }}</td>
                <td>{{ $material->product_number }}</td>
                <td>{{ $material->stock }}</td>
                <td>
                    <form action="#" method="POST">
                        @csrf
                        <input type="number" name="quantity" min="1" max="{{ $material->stock }}">
                        <button type="submit">Bestel</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    
</body>
</html>