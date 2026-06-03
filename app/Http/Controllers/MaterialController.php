<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;

class MaterialController extends Controller
{
    public function index() {
        $materials = Material::all();
            
        return view('pages.materiaal', compact('materials'));
    }

    public function order(Request $request, $id) {
    
    $request->validate([
        'quantity' => 'required|integer|min:1',
        'material_id' => 'required',
    ]);

    $material = Material::findOrFail($id);

    if ($request->quantity > $material->stock) {
        return redirect()->back()->withErrors(['quantity' => 'Meer dan de volledige voorraad bestellen, is niet mogelijk!']);
    }

    $material->stock -= $request->quantity;
    $material->save();

    return redirect()->back()->with('Success', 'Materiaal in winkelmandje toegevoegd!');
    }
}
