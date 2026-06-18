<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class MaterialListSeeder extends Seeder
{
    private array $gewichten = [
        'Aansluitdoos'                         => 0.30,
        'Accuboormachine'                      => 2.00,
        'Afvoerleidingssysteem'                => 3.00,
        'Batterijaccu'                         => 5.00,
        'Borgmoeren'                           => 0.10,
        'Bout-A2'                              => 0.10,
        'Bout-A4'                              => 0.10,
        'Bout-M10'                             => 0.05,
        'Bout-M12'                             => 0.15,
        'Bout-M16'                             => 0.25,
        'Bout-M6'                              => 0.01,
        'Bout-M8'                              => 0.03,
        'Bout-anker'                           => 0.10,
        'Bout-inbus'                           => 0.01,
        'Bout-klei'                            => 0.02,
        'Bout-verzinkt'                        => 0.02,
        'Bout-zeskantkop'                      => 0.04,
        'Breekijzer'                           => 2.00,
        'Combinatietang'                       => 0.30,
        'Contactspray'                         => 1.00,
        'Dompelpomp'                           => 12.00,
        'Dopsleutelset-inch'                   => 7.00,
        'Dopsleutelset-meter'                  => 1.50,
        'Draadstang-M10'                       => 0.40,
        'Draadstang-M12'                       => 0.60,
        'Draadstang-M16'                       => 1.00,
        'Draadstang-M6'                        => 0.20,
        'Draadstang-M8'                        => 0.30,
        'Drukleidingssysteem'                  => 4.00,
        'Ducttape'                             => 0.15,
        'EHBO-kit'                             => 0.80,
        'EPDM-papier'                          => 3.00,
        'Flensmoeren'                          => 0.10,
        'Fles-Perslucht'                       => 5.00,
        'Fluovesten'                           => 0.30,
        'Gardena-koppeling'                    => 0.10,
        'Gasdetectietoestel'                   => 0.60,
        'Gasdetector'                          => 1.50,
        'Gehoorkappen'                         => 0.20,
        'Geka-koppeling'                       => 0.30,
        'Gelaatscherm'                         => 0.40,
        'HILTI'                                => 5.30,
        'Haakse-slijper'                       => 2.50,
        'Hamer'                                => 0.80,
        'Handschoenen-chemisch-resistent'      => 0.15,
        'Harnas'                               => 1.20,
        'Hogedrukreiniger'                     => 25.00,
        'Inslagmoeren'                         => 0.10,
        'Inspectiecamera'                      => 1.50,
        'Isolatietape'                         => 0.10,
        'Kabelschoenen'                        => 0.05,
        'Kabelschoentang'                      => 0.25,
        'Kabelset'                             => 4.50,
        'Kabelstripper'                        => 0.20,
        'Karabijnhaak'                         => 0.15,
        'Kettingen'                            => 2.00,
        'Kettingspray'                         => 1.20,
        'Klopboormachine'                      => 2.50,
        'Kniptang'                             => 0.25,
        'Koppeling-camlock'                    => 0.35,
        'Krimptang'                            => 0.30,
        'Kruiskopschroef'                      => 0.03,
        'Kruiskopschroevendraaier'             => 0.20,
        'Kunststofhamer'                       => 0.50,
        'Laserwaterpas'                        => 0.80,
        'Laskist'                              => 15.00,
        'Lasmateriaal'                         => 1.00,
        'Lifeline'                             => 0.80,
        'Loctite'                              => 0.05,
        'Losse-inbussleutel'                   => 0.10,
        'Mangatopener'                         => 3.00,
        'Markeringstape'                       => 0.08,
        'Meetlint'                             => 0.30,
        'Moker'                                => 5.00,
        'Momentsleutel'                        => 1.50,
        'Monstername-apparatuur'               => 2.50,
        'Multimeter'                           => 0.35,
        'O-ringen'                             => 0.01,
        'Ontstoppingsveer'                     => 2.00,
        'Oordoppen'                            => 0.02,
        'Overall-vlamvertragend'               => 0.80,
        'Overall-waterafstotend'               => 0.70,
        'PE-slang'                             => 1.00,
        'PLC-onderdelen'                       => 0.50,
        'PTFE-tape'                            => 0.05,
        'PVC-Tstuk'                            => 0.50,
        'PVC-bocht'                            => 0.35,
        'PVC-slang'                            => 0.60,
        'Pakpapier'                            => 0.30,
        'Parkervijs'                           => 0.03,
        'Persslang'                            => 1.20,
        'Platte-schroevendraaier'              => 0.30,
        'Pneumatische-koppelingen'             => 0.25,
        'Punttang'                             => 1.00,
        'Putdekselhaak'                        => 1.50,
        'Radar-niveaumeter'                    => 1.20,
        'Rags'                                 => 0.50,
        'Regenbroek'                           => 0.40,
        'Regencape'                            => 0.20,
        'Regenjas'                             => 0.60,
        'Relais'                               => 0.10,
        'Repair-lijm'                          => 0.10,
        'Reservemotor'                         => 25.00,
        'Ringsleutel'                          => 0.30,
        'Rioolcamera'                          => 5.00,
        'Rioolstop'                            => 1.50,
        'Rolmeter'                             => 0.30,
        'Rubberpapier'                         => 0.60,
        'Schroefmachine'                       => 1.80,
        'Schroevendraaiers-geïsoleerd'         => 0.20,
        'Set-Wartel'                           => 0.40,
        'Signalisatiekledij'                   => 0.50,
        'Siliconenkit'                         => 0.30,
        'Slagmoersleutel'                      => 3.50,
        'Slangenwagen'                         => 20.00,
        'Slangklemmen'                         => 0.05,
        'Sluitring'                            => 0.02,
        'Smeervet-EP2'                         => 1.00,
        'Smeervet-Foodgrease'                  => 1.00,
        'Smeervet-Lithium'                     => 1.00,
        'Snijvaste-Werkhandschoenen'           => 0.10,
        'Spaanplaatschroef'                    => 0.005,
        'Spanningstester'                      => 0.10,
        'Staalnamepot'                         => 0.05,
        'Stofmasker-ffp2'                      => 0.01,
        'Stofmasker-ffp3'                      => 0.02,
        'Tabbout'                              => 0.20,
        'Tandveerring'                         => 0.001,
        'Tie-wraps'                            => 0.02,
        'Torx-schroef'                         => 0.03,
        'Torx-schroevendraaier'                => 0.15,
        'Trillingsdemper'                      => 0.25,
        'Ultrasone-niveaumeter'                => 1.00,
        'V-snaren'                             => 0.35,
        'Valharnas-lijn'                       => 3.00,
        'Veerring'                             => 0.01,
        'Veiligheidsbril'                      => 0.03,
        'Veiligheidshelm-kinband'              => 0.50,
        'Veiligheidsschoenen-antistatisch'     => 2.00,
        'Veiligheidsschoenen-s3'               => 2.00,
        'Veiligheidsschoenen-stalen-tip'       => 1.50,
        'Voltterschakelaar'                    => 0.10,
        'WD-40'                                => 0.40,
        'Waterpas'                             => 0.50,
        'Waterpomptang'                        => 0.50,
        'Werklaarzen-nitril'                   => 3.50,
        'Werklaarzen-pvc'                      => 2.00,
        'Werklaarzen-stalen-zool'              => 2.50,
        'Zelftappendevijs'                     => 0.05,
        'Zeskantmoeren'                        => 0.05,
        'Antistatisch-overall'                 => 1.00,
        'Handontsmetting'                      => 0.25,
        'handschoenen-elektrisch-geïsoleerd'   => 0.80,
    ];

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
                'stock'         => 1000,
                'weight'        => $this->gewichten[$productNaam] ?? 0.00,
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

        if (preg_match('/(vet|pakking|tape|loctite|slang|fitting|bocht|stuk|koppeling|relais|reserve|plc|motor|wartel|doos|systeem|demper)/', $naamKlein)) {
            return 'Technische onderhoudsmaterialen';
        }

        if (preg_match('/(riool|camera|toestel|veer|reiniger|wagen|pomp|stop|schakelaar|meting|pot|apparatuur)/', $naamKlein)) {
            return 'Specifieke Aquafin/riolering gerelateerde tools';
        }

        return 'Diversen/Verbruiksgoederen';
    }
}