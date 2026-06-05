<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Material;

use Illuminate\Support\Facades\DB;

class MaterialListSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('materiallist')->insert([
            [
                'productname' => 'Bout M6',
                'productnumber' => '00001',
                'category' => 'Bevestigingsmateriaal',
                'stock' => 100
            ],
          
            [
                'productname' => 'Bout M8',
                'productnumber' => '00002',
                'category' => 'Bevestigingsmateriaal',
                'stock' => 100
            ],
            [
                'productname' => 'Bout M10',
                'productnumber' => '00003',
                'category' => 'Bevestigingsmateriaal',
                'stock' => 100
            ],
            [
                'productname' => 'Bout M12',
                'productnumber' => '00004',
                'category' => 'Bevestigingsmateriaal',
                'stock' => 100
            ],
            [
                'productname' => 'Bout M16',
                'productnumber' => '00005',
                'category' => 'Bevestigingsmateriaal',
                'stock' => 100
            ],
            [
                'productname' => 'Bout inox A2',
                'productnumber' => '00006',
                'category' => 'Bevestigingsmateriaal',
                'stock' => 100
            ],
            [
                'productname' => 'Bout inox A4',
                'productnumber' => '00007',
                'category' => 'Bevestigingsmateriaal',
                'stock' => 100
            ],
            [
                'productname' => 'Bout verzinkt',
                'productnumber' => '00008',
                'category' => 'Bevestigingsmateriaal',
                'stock' => 100
            ],
            [
                'productname' => 'Zeskantmoer',
                'productnumber' => '00009',
                'category' => 'Bevestigingsmateriaal',
                'stock' => 100
            ],
            [
                'productname' => 'Borgmoer',
                'productnumber' => '00010',
                'category' => 'Bevestigingsmateriaal',
                'stock' => 100
            ],
            [
                'productname' => 'Flensmoer',
                'productnumber' => '00011',
                'category' => 'Bevestigingsmateriaal',
                'stock' => 100
            ],
          [
                'productname' => 'Sluitring',
                'productnumber' => '00012',
                'category' => 'Bevestigingsmateriaal',
                'stock' => 100
            ],
            [
                'productname' => 'Veerring',
                'productnumber' => '00013',
                'category' => 'Bevestigingsmateriaal',
                'stock' => 100
            ],
            [
                'productname' => 'Tandring',
                'productnumber' => '00014',
                'category' => 'Bevestigingsmateriaal',
                'stock' => 100
            ],
            [
                'productname' => 'Ankerbout',
                'productnumber' => '00015',
                'category' => 'Bevestigingsmateriaal',
                'stock' => 100
            ],
            [
                'productname' => 'Chemische anker',
                'productnumber' => '00016',
                'category' => 'Bevestigingsmateriaal',
                'stock' => 100
            ],
            [
                'productname' => 'Keilbout',
                'productnumber' => '00017',
                'category' => 'Bevestigingsmateriaal',
                'stock' => 100
            ],
            [
                'productname' => 'Draadstang M6',
                'productnumber' => '00018',
                'category' => 'Bevestigingsmateriaal',
                'stock' => 100
            ],
            [
                'productname' => 'Draadstang M8',
                'productnumber' => '00019',
                'category' => 'Bevestigingsmateriaal',
                'stock' => 100
            ],
           
            [
                'productname' => 'Draadstang M10',
                'productnumber' => '00020',
                'category' => 'Bevestigingsmateriaal',
                'stock' => 100
            ],
            [
                'productname' => 'Draadstang M12',
                'productnumber' => '00021',
                'category' => 'Bevestigingsmateriaal',
                'stock' => 100
            ],
            [
                'productname' => 'Draadstang M14',
                'productnumber' => '00022',
                'category' => 'Bevestigingsmateriaal',
                'stock' => 100
            ],
            [
                'productname' => 'Draadstang M16',
                'productnumber' => '00023',
                'category' => 'Bevestigingsmateriaal',
                'stock' => 100
            ],
            [
                'productname' => 'Inslagmoer',
                'productnumber' => '00024',
                'category' => 'Bevestigingsmateriaal',
                'stock' => 100
            ],
            [
                'productname' => 'Tapbout',
                'productnumber' => '00025',
                'category' => 'Bevestigingsmateriaal',
                'stock' => 100
            ],
            [
                'productname' => 'Zeskantkopbout',
                'productnumber' => '00026',
                'category' => 'Bevestigingsmateriaal',
                'stock' => 100
            ],
             [
                'productname' => 'Inbusbout',
                'productnumber' => '00027',
                'category' => 'Bevestigingsmateriaal',
                'stock' => 100
            ],
            [
                'productname' => 'Torxschroef',
                'productnumber' => '00028',
                'category' => 'Bevestigingsmateriaal',
                'stock' => 100
            ],
            [
                'productname' => 'Kruiskopschroef',
                'productnumber' => '00029',
                'category' => 'Bevestigingsmateriaal',
                'stock' => 100
            ],
            [
                'productname' => 'Zelftappende vijs',
                'productnumber' => '00030',
                'category' => 'Bevestigingsmateriaal',
                'stock' => 100
            ],
            [
                'productname' => 'Parkervijs',
                'productnumber' => '00031',
                'category' => 'Bevestigingsmateriaal',
                'stock' => 100
            ],
             [
                'productname' => 'Spaanplaatsschroef',
                'productnumber' => '00032',
                'category' => 'Bevestigingsmateriaal',
                'stock' => 100
            ],
             [
                'productname' => 'Slangenklem',
                'productnumber' => '00033',
                'category' => 'Bevestigingsmateriaal',
                'stock' => 100
            ],
            [
                'productname' => 'Veiligheidshelm (met kinband)',
                'productnumber' => '00034',
                'category' => 'Persoonlijke beschermingsmiddelen (PBM)',
                'stock' => 100
            ],
            [
                'productname' => 'Oordoppen / gehoorkappen',
                'productnumber' => '00035',
                'category' => 'Persoonlijke beschermingsmiddelen (PBM)',
                'stock' => 100
            ],
            [
                'productname' => 'Veiligheidsbril / gelaatsscherm',
                'productnumber' => '00036',
                'category' => 'Persoonlijke beschermingsmiddelen (PBM)',
                'stock' => 100
            ],
            [
                'productname' => 'Stofmasker FFP2',
                'productnumber' => '00037',
                'category' => 'Persoonlijke beschermingsmiddelen (PBM)',
                'stock' => 100
            ],
            [
                'productname' => 'Stofmasker FFP3',
                'productnumber' => '00038',
                'category' => 'Persoonlijke beschermingsmiddelen (PBM)',
                'stock' => 100
            ],
            [
                'productname' => 'Werkhandschoenen snijvast',
                'productnumber' => '00039',
                'category' => 'Persoonlijke beschermingsmiddelen (PBM)',
                'stock' => 100
            ],
            [
                'productname' => 'Werkhandschoenen chemisch resistent',
                'productnumber' => '00040',
                'category' => 'Persoonlijke beschermingsmiddelen (PBM)',
                'stock' => 100
            ],
            [
                'productname' => 'Werkhandschoenen elektrisch geisoleerd',
                'productnumber' => '00041',
                'category' => 'Persoonlijke beschermingsmiddelen (PBM)',
                'stock' => 100
            ],
            [
                'productname' => ' Werklaarzen PVC',
                'productnumber' => '00042',
                'category' => 'Persoonlijke beschermingsmiddelen (PBM)',
                'stock' => 100
            ],
            [
                'productname' => 'Werklaarzen nitril',
                'productnumber' => '00043',
                'category' => 'Persoonlijke beschermingsmiddelen (PBM)',
                'stock' => 100
            ],
            [
                'productname' => 'Werklaarzen met stalen zool',
                'productnumber' => '00044',
                'category' => 'Persoonlijke beschermingsmiddelen (PBM)',
                'stock' => 100
            ],
            [
                'productname' => 'Veiligheidsschoenen S3',
                'productnumber' => '00045',
                'category' => 'Persoonlijke beschermingsmiddelen (PBM)',
                'stock' => 100
            ],
            [
                'productname' => 'Veiligheidsschoenen  antistatisch',
                'productnumber' => '00046',
                'category' => 'Persoonlijke beschermingsmiddelen (PBM)',
                'stock' => 100
            ],
            [
                'productname' => 'Veiligheidsschoenen stalen tip',
                'productnumber' => '00047',
                'category' => 'Persoonlijke beschermingsmiddelen (PBM)',
                'stock' => 100
            ],
            [
                'productname' => 'Regenjas',
                'productnumber' => '00048',
                'category' => 'Persoonlijke beschermingsmiddelen (PBM)',
                'stock' => 100
            ],
            [
                'productname' => 'Regenbroek',
                'productnumber' => '00049',
                'category' => 'Persoonlijke beschermingsmiddelen (PBM)',
                'stock' => 100
            ],
            [
                'productname' => 'Regencapes',
                'productnumber' => '00050',
                'category' => 'Persoonlijke beschermingsmiddelen (PBM)',
                'stock' => 100
            ],
            [
                'productname' => 'Fluovest (EN ISO 20471)',
                'productnumber' => '00051',
                'category' => 'Persoonlijke beschermingsmiddelen (PBM)',
                'stock' => 100
            ],
            [
                'productname' => 'Overall brandvertragend',
                'productnumber' => '00052',
                'category' => 'Persoonlijke beschermingsmiddelen (PBM)',
                'stock' => 100
            ],
            [
                'productname' => 'Overall antistatisch',
                'productnumber' => '00053',
                'category' => 'Persoonlijke beschermingsmiddelen (PBM)',
                'stock' => 100
            ],
            [
                'productname' => 'Overall waterafstotend',
                'productnumber' => '00054',
                'category' => 'Persoonlijke beschermingsmiddelen (PBM)',
                'stock' => 100
            ],
            [
                'productname' => 'Valharnas en lijn',
                'productnumber' => '00055',
                'category' => 'Persoonlijke beschermingsmiddelen (PBM)',
                'stock' => 100
            ],
            [
                'productname' => 'Gasdetectiemeter (O₂, CH₄, H₂S, CO)',
                'productnumber' => '00056',
                'category' => 'Persoonlijke beschermingsmiddelen (PBM)',
                'stock' => 100
            ],
            [
                'productname' => 'Handontsmetting',
                'productnumber' => '00057',
                'category' => 'Persoonlijke beschermingsmiddelen (PBM)',
                'stock' => 100
            ],
            [
                'productname' => 'EHBO-kit',
                'productnumber' => '00058',
                'category' => 'Persoonlijke beschermingsmiddelen (PBM)',
                'stock' => 100
            ],
            [
                'productname' => 'Harnas',
                'productnumber' => '00059',
                'category' => 'Persoonlijke beschermingsmiddelen (PBM)',
                'stock' => 100
            ],
            [
                'productname' => 'Lifeline',
                'productnumber' => '00060',
                'category' => 'Persoonlijke beschermingsmiddelen (PBM)',
                'stock' => 100
            ],
            [
                'productname' => 'Karabijnhaken',
                'productnumber' => '00061',
                'category' => 'Persoonlijke beschermingsmiddelen (PBM)',
                'stock' => 100
            ],
            [
                'productname' => 'Dopsleutelsets metrisch',
                'productnumber' => '00062',
                'category' => 'Gereedschap (manueel & elektrisch)',
                'stock' => 100
            ],
            [
                'productname' => 'Dopsleutelsets inch',
                'productnumber' => '00063',
                'category' => 'Gereedschap (manueel & elektrisch)',
                'stock' => 100
            ],
            [
                'productname' => ' Ringsleutel',
                'productnumber' => '00064',
                'category' => 'Gereedschap (manueel & elektrisch)',
                'stock' => 100
            ],
            [
                'productname' => 'Steeksleutel',
                'productnumber' => '00065',
                'category' => 'Gereedschap (manueel & elektrisch)',
                'stock' => 100
            ],
            [
                'productname' => 'Momentsleutel',
                'productnumber' => '00066',
                'category' => 'Gereedschap (manueel & elektrisch)',
                'stock' => 100
            ],
            [
                'productname' => 'Inbussleutel los',
                'productnumber' => '00067',
                'category' => 'Gereedschap (manueel & elektrisch)',
                'stock' => 100
            ],
            [
                'productname' => 'Inbussleutel set',
                'productnumber' => '00068',
                'category' => 'Gereedschap (manueel & elektrisch)',
                'stock' => 100
            ],
            [
                'productname' => 'Schroevendraaier plat',
                'productnumber' => '00069',
                'category' => 'Gereedschap (manueel & elektrisch)',
                'stock' => 100
            ],
            [
                'productname' => 'Schroevendraaier kruiskop',
                'productnumber' => '00070',
                'category' => 'Gereedschap (manueel & elektrisch)',
                'stock' => 100
            ],
            [
                'productname' => 'Schroevendraaier Torx',
                'productnumber' => '00071',
                'category' => 'Gereedschap (manueel & elektrisch)',
                'stock' => 100
            ],
           [
                'productname' => 'Schroevendraaier geisoleerd',
                'productnumber' => '00072',
                'category' => 'Gereedschap (manueel & elektrisch)',
                'stock' => 100
            ],
            [
                'productname' => 'Combinatietang',
                'productnumber' => '00073',
                'category' => 'Gereedschap (manueel & elektrisch)',
                'stock' => 100
            ],
            [
                'productname' => 'Waterpomptang',
                'productnumber' => '00074',
                'category' => 'Gereedschap (manueel & elektrisch)',
                'stock' => 100
            ],
            [
                'productname' => 'Kniptang',
                'productnumber' => '00075',
                'category' => 'Gereedschap (manueel & elektrisch)',
                'stock' => 100
            ],
            [
                'productname' => 'Punttang',
                'productnumber' => '00076',
                'category' => 'Gereedschap (manueel & elektrisch)',
                'stock' => 100
            ],
            [
                'productname' => 'Krimptang / kabelschoentang',
                'productnumber' => '00077',
                'category' => 'Gereedschap (manueel & elektrisch)',
                'stock' => 100
            ],
            [
                'productname' => 'Kabelstripper',
                'productnumber' => '00078',
                'category' => 'Gereedschap (manueel & elektrisch)',
                'stock' => 100
            ],
            [
                'productname' => 'Hamer',
                'productnumber' => '00079',
                'category' => 'Gereedschap (manueel & elektrisch)',
                'stock' => 100
            ],
            [
                'productname' => 'Kunststofhamer',
                'productnumber' => '00080',
                'category' => 'Gereedschap (manueel & elektrisch)',
                'stock' => 100
            ],
            [
                'productname' => 'Moker',
                'productnumber' => '00081',
                'category' => 'Gereedschap (manueel & elektrisch)',
                'stock' => 100
            ],
            [
                'productname' => 'Breekijzer',
                'productnumber' => '00082',
                'category' => 'Gereedschap (manueel & elektrisch)',
                'stock' => 100
            ],
            [
                'productname' => 'Slijpmachine (haakse slijper)',
                'productnumber' => '00083',
                'category' => 'Gereedschap (manueel & elektrisch)',
                'stock' => 100
            ],
            [
                'productname' => 'Accuboormachine',
                'productnumber' => '00084',
                'category' => 'Gereedschap (manueel & elektrisch)',
                'stock' => 100
            ],
            [
                'productname' => 'Klopboormachine',
                'productnumber' => '00085',
                'category' => 'Gereedschap (manueel & elektrisch)',
                'stock' => 100
            ],
            [
                'productname' => 'Schroefmachine',
                'productnumber' => '00086',
                'category' => 'Gereedschap (manueel & elektrisch)',
                'stock' => 100
            ],
            [
                'productname' => 'Slagmoersleutel (pneumatisch)',
                'productnumber' => '00087',
                'category' => 'Gereedschap (manueel & elektrisch)',
                'stock' => 100
            ],
            [
                'productname' => 'Slagmoersleutel (accu)',
                'productnumber' => '00088',
                'category' => 'Gereedschap (manueel & elektrisch)',
                'stock' => 100
            ],
            [
                'productname' => 'Waterpas',
                'productnumber' => '00089',
                'category' => 'Gereedschap (manueel & elektrisch)',
                'stock' => 100
            ],
            [
                'productname' => 'Laserwaterpas',
                'productnumber' => '00090',
                'category' => 'Gereedschap (manueel & elektrisch)',
                'stock' => 100
            ],
            [
                'productname' => 'Meetlint',
                'productnumber' => '00091',
                'category' => 'Gereedschap (manueel & elektrisch)',
                'stock' => 100
            ],
            [
                'productname' => 'Spanningstester',
                'productnumber' => '00092',
                'category' => 'Gereedschap (manueel & elektrisch)',
                'stock' => 100
            ],
            [
                'productname' => 'Multimeter',
                'productnumber' => '00093',
                'category' => 'Gereedschap (manueel & elektrisch)',
                'stock' => 100
            ],
            [
                'productname' => 'Laskist',
                'productnumber' => '00094',
                'category' => 'Gereedschap (manueel & elektrisch)',
                'stock' => 100
            ],
            [
                'productname' => 'Lasmateriaal',
                'productnumber' => '00095',
                'category' => 'Gereedschap (manueel & elektrisch)',
                'stock' => 100
            ],
            [
                'productname' => 'Smeervet foodgrade',
                'productnumber' => '00096',
                'category' => ' Technische onderhoudsmaterialen',
                'stock' => 100
            ],
            [
                'productname' => 'Smeervet EP2',
                'productnumber' => '00097',
                'category' => 'Technische onderhoudsmaterialen',
                'stock' => 100
            ],
            [
                'productname' => 'Smeervet lithium',
                'productnumber' => '00098',
                'category' => 'Technische onderhoudsmaterialen',
                'stock' => 100
            ],
            [
                'productname' => 'O-ring',
                'productnumber' => '00099',
                'category' => 'Technische onderhoudsmaterialen',
                'stock' => 100
            ],
            [
                'productname' => 'Pakking papier',
                'productnumber' => '00100',
                'category' => 'Technische onderhoudsmaterialen',
                'stock' => 100
            ],
            [
                'productname' => 'Pakking rubber',
                'productnumber' => '00101',
                'category' => 'Technische onderhoudsmaterialen',
                'stock' => 100
            ],
            [
                'productname' => 'Pakking EPDM',
                'productnumber' => '00102',
                'category' => 'Technische onderhoudsmaterialen',
                'stock' => 100
            ],
            [
                'productname' => 'PTFE tape',
                'productnumber' => '00103',
                'category' => ' Technische onderhoudsmaterialen',
                'stock' => 100
            ],
            [
                'productname' => 'Loctite',
                'productnumber' => '00104',
                'category' => ' Technische onderhoudsmaterialen',
                'stock' => 100
            ],
            [
                'productname' => 'PVC slang',
                'productnumber' => '00105',
                'category' => 'Technische onderhoudsmaterialen',
                'stock' => 100
            ],
            [
                'productname' => 'PE slang',
                'productnumber' => '00106',
                'category' => 'Technische onderhoudsmaterialen',
                'stock' => 100
            ],
            [
                'productname' => 'Persslang',
                'productnumber' => '00107',
                'category' => 'Technische onderhoudsmaterialen',
                'stock' => 100
            ],
            [
                'productname' => 'PVC-fitting',
                'productnumber' => '00108',
                'category' => 'Technische onderhoudsmaterialen',
                'stock' => 100
            ],
            [
                'productname' => 'Bochten',
                'productnumber' => '00109',
                'category' => 'Technische onderhoudsmaterialen',
                'stock' => 100
            ],
            [
                'productname' => 'T-stuk',
                'productnumber' => '00110',
                'category' => 'Technische onderhoudsmaterialen',
                'stock' => 100
            ],
            [
                'productname' => 'Koppeling Geka',
                'productnumber' => '00111',
                'category' => 'Technische onderhoudsmaterialen',
                'stock' => 100
            ],
            [
                'productname' => 'Koppeling Gardena',
                'productnumber' => '00112',
                'category' => ' Technische onderhoudsmaterialen',
                'stock' => 100
            ],
            [
                'productname' => 'Koppeling Camlock',
                'productnumber' => '00113',
                'category' => 'Technische onderhoudsmaterialen',
                'stock' => 100
            ],
            [
                'productname' => 'V-snaar',
                'productnumber' => '00114',
                'category' => 'Technische onderhoudsmaterialen',
                'stock' => 100
            ],
            [
                'productname' => 'Kabels en wartels M16',
                'productnumber' => '00115',
                'category' => 'Technische onderhoudsmaterialen',
                'stock' => 100
            ],
            [
                'productname' => 'Kabels en wartels M20',
                'productnumber' => '00116',
                'category' => 'Technische onderhoudsmaterialen',
                'stock' => 100
            ],
            [
                'productname' => 'Kabels en wartels M25',
                'productnumber' => '00117',
                'category' => 'Technische onderhoudsmaterialen',
                'stock' => 100
            ],
            [
                'productname' => 'Kabels en wartels M32',
                'productnumber' => '00118',
                'category' => 'Technische onderhoudsmaterialen',
                'stock' => 100
            ],
            [
                'productname' => 'Aansluitdoos',
                'productnumber' => '00119',
                'category' => 'Technische onderhoudsmaterialen',
                'stock' => 100
            ],
            [
                'productname' => 'Leidingsysteem druk',
                'productnumber' => '00120',
                'category' => 'Technische onderhoudsmaterialen',
                'stock' => 100
            ],
            [
                'productname' => 'Leidingsysteem afvoer',
                'productnumber' => '00121',
                'category' => 'Technische onderhoudsmaterialen',
                'stock' => 100
            ],
            [
                'productname' => 'Pneumatische koppeling',
                'productnumber' => '00122',
                'category' => ' Technische onderhoudsmaterialen',
                'stock' => 100
            ],
            [
                'productname' => 'Trillingsdempers',
                'productnumber' => '00123',
                'category' => 'Technische onderhoudsmaterialen',
                'stock' => 100
            ],
            [
                'productname' => 'Putdekselhaak',
                'productnumber' => '00124',
                'category' => 'Specifieke  Aquafin/riolering gerelateerde tools',
                'stock' => 100
            ],
            [
                'productname' => 'Rioolcamera/inspectiecamera',
                'productnumber' => '00125',
                'category' => 'Specifieke  Aquafin/riolering gerelateerde tools',
                'stock' => 100
            ],
            [
                'productname' => 'Gasdetectietoestellen (H₂S, CO, O₂)',
                'productnumber' => '00126',
                'category' => 'Specifieke  Aquafin/riolering gerelateerde tools',
                'stock' => 100
            ],
            [
                'productname' => 'Onstoppingsveer',
                'productnumber' => '00127',
                'category' => 'Specifieke  Aquafin/riolering gerelateerde tools',
                'stock' => 100
            ],
            [
                'productname' => 'Hogedrukreiniger',
                'productnumber' => '00128',
                'category' => 'Specifieke  Aquafin/riolering gerelateerde tools',
                'stock' => 100
            ],
            [
                'productname' => 'Slangenwagens',
                'productnumber' => '00129',
                'category' => 'Specifieke  Aquafin/riolering gerelateerde tools',
                'stock' => 100
            ],
            [
                'productname' => 'Dompelpompen',
                'productnumber' => '00130',
                'category' => ' Specifieke  Aquafin/riolering gerelateerde tools',
                'stock' => 100
            ],
            [
                'productname' => 'Rioolstoppen',
                'productnumber' => '00131',
                'category' => 'Specifieke  Aquafin/riolering gerelateerde tools',
                'stock' => 100
            ],
            [
                'productname' => 'Vlotterschakelaars',
                'productnumber' => '00132',
                'category' => 'Specifieke  Aquafin/riolering gerelateerde tools',
                'stock' => 100
            ],
            [
                'productname' => 'Niveaumeting ultrasoon',
                'productnumber' => '00133',
                'category' => 'Specifieke  Aquafin/riolering gerelateerde tools',
                'stock' => 100
            ],
            [
                'productname' => 'Niveaumeting radar',
                'productnumber' => '00134',
                'category' => 'Specifieke  Aquafin/riolering gerelateerde tools',
                'stock' => 100
            ],
            [
                'productname' => 'Staalnamepot',
                'productnumber' => '00135',
                'category' => 'Specifieke  Aquafin/riolering gerelateerde tools',
                'stock' => 100
            ],
            [
                'productname' => 'Monsternameapparatuur',
                'productnumber' => '00136',
                'category' => 'Specifieke  Aquafin/riolering gerelateerde tools',
                'stock' => 100
            ],
            [
                'productname' => 'Tie-wraps',
                'productnumber' => '00137',
                'category' => 'Diversen/Verbruiksgoederen',
                'stock' => 100
            ],
            [
                'productname' => 'Kabelschoenen',
                'productnumber' => '00138',
                'category' => 'Diversen/Verbruiksgoederen',
                'stock' => 100
            ],
            [
                'productname' => 'Markeringstape',
                'productnumber' => '00139',
                'category' => 'Diversen/Verbruiksgoederen',
                'stock' => 100
            ],
            [
                'productname' => 'Siliconenkit',
                'productnumber' => '00140',
                'category' => 'Diversen/Verbruiksgoederen',
                'stock' => 100
            ],
            [
                'productname' => 'Lijm',
                'productnumber' => '00141',
                'category' => 'Diversen/Verbruiksgoederen',
                'stock' => 100
            ],
            [
                'productname' => 'Rags / reinigingsdoekjes',
                'productnumber' => '00142',
                'category' => 'Diversen/Verbruiksgoederen',
                'stock' => 100
            ],
            [
                'productname' => 'Sprays WD-40',
                'productnumber' => '00143',
                'category' => 'Diversen/Verbruiksgoederen',
                'stock' => 100
            ],
            [
                'productname' => 'Contactspray',
                'productnumber' => '00144',
                'category' => 'Diversen/Verbruiksgoederen',
                'stock' => 100
            ],
            [
                'productname' => 'Kettingspray',
                'productnumber' => '00145',
                'category' => 'Diversen/Verbruiksgoederen',
                'stock' => 100
            ],
            [
                'productname' => 'Duct tape',
                'productnumber' => '00146',
                'category' => 'Diversen/Verbruiksgoederen',
                'stock' => 100
            ],
            [
                'productname' => 'Isolatietape',
                'productnumber' => '00147',
                'category' => 'Diversen/Verbruiksgoederen',
                'stock' => 100
            ],
            [
                'productname' => 'Batterijen / accu',
                'productnumber' => '00148',
                'category' => 'Diversen/Verbruiksgoederen',
                'stock' => 100
            ],
            [
                'productname' => 'Motoren reserve',
                'productnumber' => '00149',
                'category' => 'Diversen/Verbruiksgoederen',
                'stock' => 100
            ],
            [
                'productname' => 'PLC-onderdelen reserve',
                'productnumber' => '00150',
                'category' => 'Diversen/Verbruiksgoederen',
                'stock' => 100
            ],
            [
                'productname' => 'Relais reserve',
                'productnumber' => '00151',
                'category' => 'Diversen/Verbruiksgoederen',
                'stock' => 100
            ],
            [
                'productname' => 'Fles met perslucht/gas',
                'productnumber' => '00152',
                'category' => 'Diversen/Verbruiksgoederen',
                'stock' => 100
            ],

           
            
            
            
            
            
            
            
            
            





















          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
        ]);
    }
}