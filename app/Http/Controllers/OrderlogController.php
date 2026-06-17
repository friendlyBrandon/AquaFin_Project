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
            $rawOrders = \App\Models\Orderlog::with('user')->orderBy('created_at', 'desc')->get();
        } else {
            $rawOrders = \App\Models\Orderlog::with('user')->where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        }

        $orders = $rawOrders->groupBy('order_id');

        return view('pages.orderlog', compact('orders'));
    }

    public function updateStatus($order_id, $status) {
        
        if (Auth::user()->is_admin == 1 || Auth::user()->is_stockMedewerker == 1) {
            
            $orderItems = \App\Models\Orderlog::where('order_id', $order_id)->get();
            
            if ($orderItems->isEmpty()) {
                return redirect()->back()->withErrors(['error' => 'Bestelling niet gevonden.']);
            }

            $huidigeStatus = $orderItems->first()->status;

            if ($status === 'accepted') {
                $nieuweStatus = 'validated';
            } 
            elseif ($status === 'rejected') {
                $nieuweStatus = 'refused';

                if ($huidigeStatus === 'pending') {
                    foreach ($orderItems as $item) {
                        $materiaal = \App\Models\Material::find($item->material_id);
                        
                        if ($materiaal) {
                            $materiaal->stock += $item->quantity;
                            $materiaal->save();
                        }
                    }
                }
            }

            \App\Models\Orderlog::where('order_id', $order_id)->update(['status' => $nieuweStatus]);
            
            return redirect()->route('orderlog.index')->with('success', 'Bestelling ' . $order_id . ' is nu: ' . strtoupper($nieuweStatus) . '. Voorraad is bijgewerkt!');
        }
        
        return redirect()->route('orderlog.index')->withErrors(['error' => 'Je hebt niet de juiste rechten om bestellingen te wijzigen!']);
    }

    public function store(Request $request) {
        $cart = session()->get('cart', []);
        if(empty($cart)) return redirect()->back();

        $vandaag = date('Ymd');

        $bestellingenVandaag = Orderlog::where('order_id', 'LIKE', 'ORD-' . $vandaag . '-%')->pluck('order_id');

        $hoogsteNummer = 0;
        foreach ($bestellingenVandaag as $bestaandeId) {
            $parts = explode('-', $bestaandeId);
            if (isset($parts[2]) && is_numeric($parts[2])) {
                $nummer = (int) $parts[2];
                if ($nummer > $hoogsteNummer) {
                    $hoogsteNummer = $nummer;
                }
            }
        }

        $nieuwNummer = $hoogsteNummer + 1;
        $volgnummer = str_pad($nieuwNummer, 4, '0', STR_PAD_LEFT);
        $orderId = 'ORD-' . $vandaag . '-' . $volgnummer;

        foreach($cart as $id => $item) {
            $echteQty   = is_array($item) ? $item['quantity'] : $item;
            $realId     = is_array($item) && isset($item['material_id']) ? $item['material_id'] : $id;
            $dimensions = is_array($item) && isset($item['dimensions']) ? $item['dimensions'] : null;
            
            $materiaal = Material::find($realId);
            $ruweNaam  = $materiaal ? $materiaal->productname : (is_array($item) ? ($item['productname'] ?? 'Onbekend') : 'Onbekend');

            Orderlog::create([
                'order_id'    => $orderId,
                'user_id'     => Auth::id(),
                'productname' => str_replace('-', ' ', $ruweNaam),
                'quantity'    => $echteQty,
                'dimensions'  => $dimensions,
                'status'      => 'pending',
                'material_id' => $realId,
            ]);
        }

        session()->forget('cart');

        if (Auth::user()->is_admin == 1 || Auth::user()->is_stockMedewerker == 1) {
            return redirect()->route('cart.index')->with('success', 'Bestelling ' . $orderId . ' is succesvol geplaatst!');
        } else {
            $aantalPending = Orderlog::where('user_id', Auth::id())
                                     ->where('status', 'pending')
                                     ->get()
                                     ->groupBy('order_id')
                                     ->count();

            $bericht = 'Bestelling ' . $orderId . ' is succesvol geplaatst!';
            return redirect()->route('cart.index')->with('success', $bericht);
        }
    }
}