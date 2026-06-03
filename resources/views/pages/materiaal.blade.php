<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materiaal</title>
</head>
<body>

        @if(session('Success'))
            <p style="color: green; font-weight: bold;">
                {{ session('Success') }}
            </p>
        @endif

        <input type="text" id="zoekbalk" placeholder="Zoek op naam of productnummer...">

        <table border="1" id="materiaalTabel">
        <thead>
            <tr>
                <th>Productnummer</th>
                <th>Naam</th>
                <th>Voorraad</th>
                <th>Bestellen</th>
            </tr>
        </thead>
        <tbody>
            @foreach($materials as $material)
            <tr class="materiaal-rij">
                <td class="prod-nummer">{{ $material->product_number }}</td>
                <td class="mat-naam">{{ $material->name }}</td>
                <td>{{ $material->stock }}</td>
                <td>
                    <form action="/materiaal/{{ $material->id }}" method="POST">
                        @csrf
                        <input type="hidden" name="material_id" value="{{ $material->id }}">
                        <input type="number" name="quantity" min="1" max="{{ $material->stock }}">
                        <button type="submit">Bestel</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        document.getElementById('zoekbalk').addEventListener('keyup', function() {

            let filter = this.value.toLowerCase();
            let rijen = document.querySelectorAll('.materiaal-rij');

            rijen.forEach(function(rij) {
                let productNummer = rij.querySelector('.prod-nummer').textContent.toLowerCase();
                let naam = rij.querySelector('.mat-naam').textContent.toLowerCase();

                if (productNummer.includes(filter) || naam.includes(filter)) {
                    rij.style.display = "";
                } else {
                    rij.style.display = "none";
                }
            });
        });
    </script>
</body>
</html>