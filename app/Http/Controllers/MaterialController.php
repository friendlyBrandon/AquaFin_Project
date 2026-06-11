<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use Illuminate\Support\Facades\Session;

class MaterialController extends Controller
{
    public function index() {
        $materials = Material::all()->map(function($material) {
            $material->category = trim($material->category);
            
            $material->productname = str_replace('-', ' ', $material->productname);
            
            return $material;
        });
            
        return view('pages.materials', compact('materials'));
    }

    public function order(Request $request) {
    
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'material_id' => 'required|exists:materiallist,id',
        ]);

        $material = Material::findOrFail($request->material_id);

        if ($request->quantity > $material->stock) {
            return redirect()->back()->withErrors(['quantity' => 'Order more than the available stock is impossible!']);
        }

        $material->stock -= $request->quantity;
        $material->save();

        $cart = session()->get('cart', []);
        $id = $material->id;
        $qty = (int) $request->quantity;

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $qty;
        } else {
            $cart[$id] = [
                "id" => $material->id,
                "productname" => str_replace('-', ' ', $material->productname),
                "productnumber" => $material->productnumber,
                "quantity" => $qty,
                "image_path" => $material->image_path,
                "category" => $material->category
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('Success', 'Het materiaal is succesvol toegevoegd aan je winkelwagen!');
    }
}