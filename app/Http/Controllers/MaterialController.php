<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use Illuminate\Support\Facades\Session;

class MaterialController extends Controller
{
    public function index() {
        $materials = Material::all();
            
        return view('pages.materials', compact('materials'));
    }

    public function order(Request $request, $id) {
    
    $request->validate([
        'quantity' => 'required|integer|min:1',
        'material_id' => 'required',
    ]);

    $material = Material::findOrFail($id);

    if ($request->quantity > $material->stock) {
        return redirect()->back()->withErrors(['quantity' => 'Order more than the available stock is impossible!']);
    }

    $material->stock -= $request->quantity;
    $material->save();

  return redirect('/cart')->with('Success', 'Material added to shopping cart!');
    }
  
public function addToCart(Request $request, $id)
{
    $qty = (int) $request->quantity;

    if ($qty < 1) {
        return back();
    }

    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        $cart[$id] += $qty;
    } else {
        $cart[$id] = $qty;
    }

    session()->put('cart', $cart);

    return redirect('/cart');
}
}

    public function order(Request $request) {
    
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'material_id' => 'required|exists:materials,id',
        ]);

        $material = Material::findOrFail($request->material_id);

        if ($request->quantity > $material->stock) {
            return redirect()->back()->withErrors(['quantity' => 'Order more than the available stock is impossible!']);
        }

        $material->stock -= $request->quantity;
        $material->save();

        return redirect()->back()->with('Success', 'Material added to shopping cart!');
    }
}