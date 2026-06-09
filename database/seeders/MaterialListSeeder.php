<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class MaterialListSeeder extends Seeder
{
    public function run(): void
    {
        $folderPad = public_path('material_pics');

        if (!File::exists($folderPad)) {
            $this->command->error("Fout: De map public/material_pics is niet gevonden!");
            return;
        }

        $bestanden = File::files($folderPad);
        
        $teller = 1;

        foreach ($bestanden as $bestand) {
            
            if (strtolower($bestand->getExtension()) !== 'png') {
                continue;
            }

            $volledigeNaam = $bestand->getFilename();
            
            $productNaam = pathinfo($volledigeNaam, PATHINFO_FILENAME);
            
            $artikelCode = str_pad($teller, 5, '0', STR_PAD_LEFT);

            $categorie = $this->raadCategorie($productNaam);

            DB::table('materiallist')->insert([
                'productname'   => $productNaam,
                'productnumber' => $artikelCode,
                'category'      => $categorie,
                'stock'         => 100,
                'image_path'    => $volledigeNaam,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);

            $teller++;
        }
    }

    private function raadCategorie(string $naam): string
    {
        $naamKlein = strtolower($naam);

        if (preg_match('/(bout|moer|ring|schroef|vijs|stang|klem)/', $naamKlein)) {
            return 'Bevestigingsmateriaal';
        }

        if (preg_match('/(helm|oordop|gehoor|bril|gelaat|masker|handschoen|laars|schoen|jas|broek|cape|vest|overall|harnas|lijn|meter|kit|ontsmetting|lifeline|haak)/', $naamKlein)) {
            return 'Persoonlijke beschermingsmiddelen (PBM)';
        }

        if (preg_match('/(sleutel|tang|stripper|hamer|moker|breek|ijzer|machine|boor|pas|lint|tester|kist|materiaal)/', $naamKlein)) {
            return 'Gereedschap (manueel & elektrisch)';
        }

        if (preg_match('/(vet|pakking|tape|loctite|slang|fitting|bocht|stuk|koppeling|relais|re reserve|plc|motor|relais|wartel|doos|systeem|demper)/', $naamKlein)) {
            return 'Technische onderhoudsmaterialen';
        }

        if (preg_match('/(riool|camera|toestel|veer|reiniger|wagen|pomp|stop|schakelaar|meting|pot|apparatuur)/', $naamKlein)) {
            return 'Specifieke Aquafin/riolering gerelateerde tools';
        }

        return 'Diversen/Verbruiksgoederen';
    }
}