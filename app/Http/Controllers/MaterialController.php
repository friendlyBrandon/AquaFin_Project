<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use Illuminate\Support\Facades\Session;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Material::all()->map(function ($material) {
            $material->category = trim($material->category);

            $material->productname = str_replace('-', ' ', $material->productname);

            return $material;
        });

        return view('pages.materials', [
            'materials' => $materials,
            'floodRisk' => session('floodRisk', false),
            'suggestedMaterials' => session('suggestedMaterials', collect()),
        ]);
    }

    public function order(Request $request)
    {

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

    public function store(Request $request)
    {
        $request->validate([
            'productname' => 'required',
            'category' => 'required',
            'stock' => 'required|integer',
        ]);

        $latest = Material::orderBy('id', 'desc')->first();
        $number = $latest ? intval(str_replace('ART-', '', $latest->productnumber)) + 1 : 1;
        $artCode = 'ART-' . str_pad($number, 5, '00', STR_PAD_LEFT);

        $material = new Material();
        $material->productname = $request->productname;
        $material->productnumber = $artCode;
        $material->category = $request->category;
        $material->stock = $request->stock;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('material_pics', 'public');
            $material->image_path = basename($path);
        }

        $material->save();
        return redirect()->back()->with('Success', 'Nieuw materiaal aangemaakt!');
    }

    public function update(Request $request)
    {
        $material = Material::findOrFail($request->material_id);

        $material->productname = $request->productname;
        $material->category = $request->category;
        $material->stock = $request->stock;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('material_pics', 'public');
            $material->image_path = basename($path);
        }

        $material->save();
        return redirect()->back()->with('Success', 'Materiaal bijgewerkt!');
    }
}