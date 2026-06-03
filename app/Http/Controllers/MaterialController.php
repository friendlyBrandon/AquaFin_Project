<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;

class MaterialController extends Controller
{
    $materials = Material::all();
        return view('materiaal', compact('materials'));
}
