<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use Illuminate\Support\Facades\Session;

class MaterialController extends Controller
{
    /**
     * Toont het overzicht van alle materialen in kaarten (cards).
     */
    public function index() {
        // Haal alle materialen op en verwijder onzichtbare spaties uit de categorienamen
        $materials = Material::all()->map(function($material) {
            $material->category = trim($material->category);
            return $material;
        });
            
        return view('pages.materials', compact('materials'));
    }

    /**
     * Verwerkt de bestelling vanaf de materialenpagina.
     * Haalt de voorraad eraf en voegt het product met alle details toe aan de winkelwagensessie.
     */
    public function order(Request $request) {
    
        // 1. Controleer of de input klopt (zoekt in de juiste tabel: materiallist)
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'material_id' => 'required|exists:materiallist,id',
        ]);

        // 2. Zoek het materiaal op in de database
        $material = Material::findOrFail($request->material_id);

        // 3. Check of er wel genoeg voorraad is
        if ($request->quantity > $material->stock) {
            return redirect()->back()->withErrors(['quantity' => 'Order more than the available stock is impossible!']);
        }

        // 4. Haal de bestelde hoeveelheid af van de voorraad en sla op
        $material->stock -= $request->quantity;
        $material->save();

        // 5. Haal het huidige winkelmandje op uit de sessie (of start een lege array)
        $cart = session()->get('cart', []);
        $id = $material->id;
        $qty = (int) $request->quantity;

        // 6. Voeg het product toe als een rijke array (voorkomt de int + array foutmelding in je cart view)
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $qty;
        } else {
            $cart[$id] = [
                "id" => $material->id,
                "productname" => $material->productname,
                "productnumber" => $material->productnumber,
                "quantity" => $qty,
                "image_path" => $material->image_path,
                "category" => $material->category
            ];
        }

        // 7. Sla het bijgewerkte winkelmandje weer op in de sessie
        session()->put('cart', $cart);

        // 8. Stuur de gebruiker door naar de winkelmand met een succesmelding
        return redirect('/cart')->with('Success', 'Material added to shopping cart!');
    }
}