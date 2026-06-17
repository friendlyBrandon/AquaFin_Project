<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FloodMaterial;
use App\Models\Material;

class FloodMaterialController extends Controller
{
    public function index()
    {
        if (!auth()->user()->is_admin) {
        abort(403);
    }
    else {
        return view('admin.floodmaterial', [
            
            'materials' => Material::orderBy('productname')->get(),
            'selected' => FloodMaterial::with('material')->get()
        ]);}
    }

    public function store(Request $request)
{
    $request->validate([
        'material_id' => 'required|exists:materiallist,id'
    ]);

    FloodMaterial::firstOrCreate([
        'material_id' => $request->material_id
    ]);

    return back()->with('success', 'Toegevoegd');
}

    public function destroy($id)
    {
        FloodMaterial::destroy($id);

        return back()->with('success', 'Materiaal verwijderd.');
    }
}
