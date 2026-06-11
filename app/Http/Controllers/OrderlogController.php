<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orderlog;
use App\Models\Material;
use Illuminate\Support\Facades\Auth;

class OrderlogController extends Controller
{
    public function index() {
        if (Auth::user()->is_admin == 1 || Auth::user()->is_stockMedewerker == 1) {
            $rawOrders = \App\Models\Orderlog::orderBy('created_at', 'desc')->get();
        } else {
            $rawOrders = \App\Models\Orderlog::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        }

        $orders = $rawOrders->groupBy('order_id');

        return view('pages.orderlog', compact('orders'));
    }

    public function updateStatus($order_id, $status) {
        if (Auth::user()->is_admin == 1 || Auth::user()->is_stockMedewerker == 1) {
            
            if ($status === 'accepted') {
                $status = 'validated';
            }
            elseif ($status === 'rejected') {
                $status = 'refused';
            }

            Orderlog::where('order_id', $order_id)->update(['status' => $status]);
            
            return redirect()->back()->with('success', 'Bestelling ' . $order_id . ' is succesvol bijgewerkt!');
        }
        
        return redirect()->back();
    }


    public function store(Request $request) {
        $cart = session()->get('cart', []);
        if(empty($cart)) return redirect()->back();

        $vandaag = date('Ymd');

        $laatsteBestelling = Orderlog::where('order_id', 'LIKE', 'ORD-' . $vandaag . '-%')
                                     ->orderBy('order_id', 'desc')
                                     ->first();

        if ($laatsteBestelling) {
            $laatsteNummer = (int) substr($laatsteBestelling->order_id, -4);
            $nieuwNummer = $laatsteNummer + 1;
        } else {
            $nieuwNummer = 1;
        }

        $volgnummer = str_pad($nieuwNummer, 4, '0', STR_PAD_LEFT);

        $orderId = 'ORD-' . $vandaag . '-' . $volgnummer;

        foreach($cart as $id => $item) {
            $echteQty = is_array($item) ? $item['quantity'] : $item;
            
            $materiaal = Material::find($id);
            $ruweNaam = $materiaal ? $materiaal->productname : (is_array($item) ? $item['productname'] : 'Onbekend');

            Orderlog::create([
                'order_id' => $orderId,
                'user_id' => Auth::id(),
                'productname' => str_replace('-', ' ', $ruweNaam),
                'quantity' => $echteQty,
                'status' => 'pending'
            ]);
        }

        session()->forget('cart');

        if (Auth::user()->is_admin == 1 || Auth::user()->is_stockMedewerker == 1) {
            
            return redirect()->route('orderlog.index')->with('success', 'Bestelling ' . $orderId . ' is succesvol geplaatst!');
            
        } else {
            
            $aantalPending = Orderlog::where('user_id', Auth::id())
                                     ->where('status', 'pending')
                                     ->get()
                                     ->groupBy('order_id')
                                     ->count();

            $bericht = 'Bestelling ' . $orderId . ' is succesvol geplaatst! Je hebt momenteel ' . $aantalPending . ' bestelling(en) in de wacht staan.';

            return redirect('/materials')->with('success', $bericht);
        }
    }
}