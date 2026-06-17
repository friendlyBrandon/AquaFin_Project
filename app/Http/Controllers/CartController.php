<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Orderlog;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        $materialIds = [];
        foreach ($cart as $key => $item) {
            $materialIds[] = is_array($item) && isset($item['material_id']) ? $item['material_id'] : $key;
        }

        $materials = Material::whereIn('id', $materialIds)
            ->get()
            ->keyBy('id');

        return view('pages.cart', compact('cart', 'materials'));
    }

    public function add(Request $request)
    {
        $id = $request->input('materiaal_id');
        $aantal = $request->input('aantal', 1);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id] += $aantal;
        } else {
            $cart[$id] = $aantal;
        }

        session()->put('cart', $cart);

        return redirect('/cart');
    }

    public function addSuggested()
    {
        $cart = session()->get('cart', []);

        $suggestedMaterials = \App\Models\FloodMaterial::with('material')
            ->get()
            ->filter(fn($item) => $item->material);

        foreach ($suggestedMaterials as $item) {

            $material = $item->material;
            $materialId = $material->id;

            if (isset($cart[$materialId])) {
                $cart[$materialId]['quantity'] += 1;
            } else {
                $cart[$materialId] = [
                    'material_id' => $materialId,
                    'productname' => $material->productname,
                    'image_path' => $material->image_path,
                    'quantity' => 1
                ];
            }
        }

        session()->put('cart', $cart);

        return redirect('/cart')->with('success', 'Aanbevolen materialen toegevoegd!');
    }

    public function addMaatwerk(Request $request)
    {
        $request->validate([
            'material_id' => 'required',
            'quantity' => 'required|integer|min:1',
            'dimensions' => 'required|string',
        ]);

        $material = Material::find($request->material_id);

        if (!$material) {
            return redirect()->back()->withErrors(['error' => 'Het geselecteerde materiaal kon niet worden gevonden.']);
        }

        $cart = session()->get('cart', []);

        $uniqueKey = 'custom_' . $material->id . '_' . time();

        $cart[$uniqueKey] = [
            'material_id' => $material->id,
            'quantity' => $request->quantity,
            'dimensions' => $request->dimensions,
            'is_custom' => true
        ];

        session()->put('cart', $cart);

        return redirect()->back()->with('Success', 'Maatwerk toegevoegd aan winkelmand!');
    }

    public function update(Request $request, $id)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);

        $nieuweAantal = (int) $request->quantity;
        $cart = session()->get('cart', []);

        if (!isset($cart[$id]))
            return redirect()->back();

        $oudeAantal = is_array($cart[$id]) ? $cart[$id]['quantity'] : $cart[$id];
        $verschil = $nieuweAantal - $oudeAantal;

        $realId = is_array($cart[$id]) && isset($cart[$id]['material_id']) ? $cart[$id]['material_id'] : $id;
        $materiaal = Material::find($realId);

        if ($verschil > 0) {
            if ($materiaal->stock < $verschil) {
                return redirect()->back()->withErrors(['error' => 'Er is niet genoeg voorraad om dit te verhogen!']);
            }
            $materiaal->stock -= $verschil;
        } elseif ($verschil < 0) {
            $materiaal->stock += abs($verschil);
        }

        $materiaal->save();

        if (is_array($cart[$id])) {
            $cart[$id]['quantity'] = $nieuweAantal;
        } else {
            $cart[$id] = $nieuweAantal;
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Aantal succesvol aangepast!');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $item = $cart[$id];
            $qtyToRemove = is_array($item) ? $item['quantity'] : $item;

            $realId = is_array($item) && isset($item['material_id']) ? $item['material_id'] : $id;

            $material = Material::find($realId);
            if ($material) {
                $material->stock += $qtyToRemove;
                $material->save();
            }

            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('Success', 'Item verwijderd en voorraad is hersteld!');
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect('/cart')->withErrors(['error' => 'Je winkelmand is leeg!']);
        }

        $orderId = 'ORD-' . date('Ymd') . '-' . rand(1000, 9999);

        foreach ($cart as $key => $item) {
            $materialId = is_array($item) && isset($item['material_id']) ? $item['material_id'] : $key;
            $quantity = is_array($item) ? $item['quantity'] : $item;
            $dimensions = is_array($item) && isset($item['dimensions']) ? $item['dimensions'] : null;

            $material = Material::find($materialId);

            Orderlog::create([
                'user_id' => Auth::id(),
                'order_id' => $orderId,
                'material_id' => $materialId,
                'productname' => $material ? $material->productname : 'Verwijderd Artikel',
                'quantity' => $quantity,
                'dimensions' => $dimensions,
                'status' => 'pending',
            ]);
        }

        session()->forget('cart');

        return redirect('/orderlog')->with('success', 'Bestelling succesvol geplaatst en wacht op goedkeuring!');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        return view('pages.cart', compact('cart'));
    }
}