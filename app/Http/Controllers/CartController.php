<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
  public function index()
{
    $cart = session()->get('cart', []);

    $materials = \App\Models\Material::whereIn('id', array_keys($cart))
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

    public function update(Request $request, $id)
    {
        $quantity = $request->input('quantity');

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id] = $quantity;
            session()->put('cart', $cart);
        }

        return redirect('/cart');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            
            $item = $cart[$id];
            $qtyToRemove = is_array($item) ? $item['quantity'] : $item;

            $material = \App\Models\Material::find($id);
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

        // Logica om de bestelling op te slaan in de database
        // Bijvoorbeeld: Order::create([...]);

        // Leeg de winkelmand na het opslaan van de bestelling
        session()->forget('cart');

        return redirect('/cart')->with('success', 'Bestelling succesvol geplaatst!');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);

        return view('pages.cart', compact('cart'));
    }
}