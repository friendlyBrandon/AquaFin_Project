<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = session()->get('cart', []);
        return view('pages.cart', compact('cartItems'));
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

        unset($cart[$id]);

        session()->put('cart', $cart);

        return redirect('/cart');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);

        return view('pages.cart', compact('cart'));
    }
}