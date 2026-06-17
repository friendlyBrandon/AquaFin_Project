<?php

namespace Database\Seeders;

use App\Models\Material;
use App\Models\FloodMaterial;
use Illuminate\Database\Seeder;

class FloodMaterialSeeder extends Seeder
{
    public function run()
    {
        $defaultMaterials = [
            'Overall-waterafstotend',
            'Werklaarzen-pvc',
            'Ontstoppingsveer',
            'Rioolcamera'
        ];

        foreach ($defaultMaterials as $productname) {

            $material = Material::where('productname', $productname)->first();

            if ($material) {
                FloodMaterial::firstOrCreate([
                    'material_id' => $material->id
                ]);
            }
        }
    }
}