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

    public function update(Request $request, $id) {
        $request->validate(['quantity' => 'required|integer|min:1']);
        
        $nieuweAantal = (int) $request->quantity;
        $cart = session()->get('cart', []);

        if(!isset($cart[$id])) return redirect()->back();

        $oudeAantal = is_array($cart[$id]) ? $cart[$id]['quantity'] : $cart[$id];
        
        $verschil = $nieuweAantal - $oudeAantal;

        $materiaal = \App\Models\Material::find($id);

        if($verschil > 0) {
            if($materiaal->stock < $verschil) {
                return redirect()->back()->withErrors(['error' => 'Er is niet genoeg voorraad om dit te verhogen!']);
            }
            $materiaal->stock -= $verschil;
        } elseif($verschil < 0) {
            $materiaal->stock += abs($verschil);
        }

        $materiaal->save();

        if(is_array($cart[$id])) {
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

        session()->forget('cart');

        return redirect('/cart')->with('success', 'Bestelling succesvol geplaatst!');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);

        return view('pages.cart', compact('cart'));
    }
}