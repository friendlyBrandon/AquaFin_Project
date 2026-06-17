<?php

namespace App\Models;

use App\Models\Material;
use Illuminate\Database\Eloquent\Model;

class FloodMaterial extends Model
{
    protected $fillable = [
        'material_id'
    ];
    protected $table = 'flood_material';

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
