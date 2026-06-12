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
        
        $bestellingen = $request->input('bestelling', []);
        
        $cart = session()->get('cart', []);
        $aantalToegevoegd = 0;

        foreach ($bestellingen as $id => $qty) {
            $qty = (int) $qty;

            if ($qty > 0) {
                $material = \App\Models\Material::find($id);

                if ($material) {
                    
                    if ($qty > $material->stock) {
                        return redirect()->back()->withErrors(['error' => 'Order more than the available stock for ' . $material->productname . ' is impossible!']);
                    }

                    $material->stock -= $qty;
                    $material->save();

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

                    $aantalToegevoegd++;
                }
            }
        }

        if ($aantalToegevoegd > 0) {
            session()->put('cart', $cart);
            return redirect()->back()->with('Success', 'Het materiaal is succesvol toegevoegd aan je winkelwagen!');
        }

        return redirect()->back()->withErrors(['error' => 'Je hebt nergens een aantal ingevuld!']);
    }
}