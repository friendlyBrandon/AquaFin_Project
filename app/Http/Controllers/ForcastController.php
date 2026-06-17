<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use App\Models\Material;

class ForcastController extends Controller
{
    public function forecast(Request $request)
    {
        // 1. De historische data in het juiste format (Date en Rainfall)
        $historicalDataArray = [
            ['Date' => '2004-01-01', 'Rainfall' => 78],
            ['Date' => '2004-02-01', 'Rainfall' => 64],
            ['Date' => '2004-03-01', 'Rainfall' => 55],
            ['Date' => '2004-04-01', 'Rainfall' => 49],
            ['Date' => '2004-05-01', 'Rainfall' => 72],
            ['Date' => '2004-06-01', 'Rainfall' => 68],
            ['Date' => '2004-07-01', 'Rainfall' => 91],
            ['Date' => '2004-08-01', 'Rainfall' => 83],
            ['Date' => '2004-09-01', 'Rainfall' => 74],
            ['Date' => '2004-10-01', 'Rainfall' => 88],
            ['Date' => '2004-11-01', 'Rainfall' => 95],
            ['Date' => '2004-12-01', 'Rainfall' => 102],
            ['Date' => '2005-01-01', 'Rainfall' => 67],
            ['Date' => '2005-02-01', 'Rainfall' => 54],
            ['Date' => '2005-03-01', 'Rainfall' => 73],
            ['Date' => '2005-04-01', 'Rainfall' => 68],
            ['Date' => '2005-05-01', 'Rainfall' => 74],
            ['Date' => '2005-06-01', 'Rainfall' => 79],
            ['Date' => '2005-07-01', 'Rainfall' => 98],
            ['Date' => '2005-08-01', 'Rainfall' => 89],
            ['Date' => '2005-09-01', 'Rainfall' => 68],
            ['Date' => '2005-10-01', 'Rainfall' => 99],
            ['Date' => '2005-11-01', 'Rainfall' => 81],
            ['Date' => '2005-12-01', 'Rainfall' => 108],

            // =======================================================
            // 2006
            ['Date' => '2006-01-01', 'Rainfall' => 66],
            ['Date' => '2006-02-01', 'Rainfall' => 45],
            ['Date' => '2006-03-01', 'Rainfall' => 61],
            ['Date' => '2006-04-01', 'Rainfall' => 57],
            ['Date' => '2006-05-01', 'Rainfall' => 70],
            ['Date' => '2006-06-01', 'Rainfall' => 82],
            ['Date' => '2006-07-01', 'Rainfall' => 85],
            ['Date' => '2006-08-01', 'Rainfall' => 78],
            ['Date' => '2006-09-01', 'Rainfall' => 77],
            ['Date' => '2006-10-01', 'Rainfall' => 94],
            ['Date' => '2006-11-01', 'Rainfall' => 100],
            ['Date' => '2006-12-01', 'Rainfall' => 103],

            // =======================================================
            // 2007
            ['Date' => '2007-01-01', 'Rainfall' => 62],
            ['Date' => '2007-02-01', 'Rainfall' => 56],
            ['Date' => '2007-03-01', 'Rainfall' => 64],
            ['Date' => '2007-04-01', 'Rainfall' => 62],
            ['Date' => '2007-05-01', 'Rainfall' => 72],
            ['Date' => '2007-06-01', 'Rainfall' => 79],
            ['Date' => '2007-07-01', 'Rainfall' => 87],
            ['Date' => '2007-08-01', 'Rainfall' => 94],
            ['Date' => '2007-09-01', 'Rainfall' => 70],
            ['Date' => '2007-10-01', 'Rainfall' => 90],
            ['Date' => '2007-11-01', 'Rainfall' => 104],
            ['Date' => '2007-12-01', 'Rainfall' => 104],

            // =======================================================
            // 2008
            ['Date' => '2008-01-01', 'Rainfall' => 66],
            ['Date' => '2008-02-01', 'Rainfall' => 45],
            ['Date' => '2008-03-01', 'Rainfall' => 63],
            ['Date' => '2008-04-01', 'Rainfall' => 61],
            ['Date' => '2008-05-01', 'Rainfall' => 79],
            ['Date' => '2008-06-01', 'Rainfall' => 81],
            ['Date' => '2008-07-01', 'Rainfall' => 89],
            ['Date' => '2008-08-01', 'Rainfall' => 83],
            ['Date' => '2008-09-01', 'Rainfall' => 63],
            ['Date' => '2008-10-01', 'Rainfall' => 91],
            ['Date' => '2008-11-01', 'Rainfall' => 98],
            ['Date' => '2008-12-01', 'Rainfall' => 115],

            // =======================================================
            // 2009
            ['Date' => '2009-01-01', 'Rainfall' => 67],
            ['Date' => '2009-02-01', 'Rainfall' => 46],
            ['Date' => '2009-03-01', 'Rainfall' => 72],
            ['Date' => '2009-04-01', 'Rainfall' => 58],
            ['Date' => '2009-05-01', 'Rainfall' => 72],
            ['Date' => '2009-06-01', 'Rainfall' => 83],
            ['Date' => '2009-07-01', 'Rainfall' => 95],
            ['Date' => '2009-08-01', 'Rainfall' => 90],
            ['Date' => '2009-09-01', 'Rainfall' => 66],
            ['Date' => '2009-10-01', 'Rainfall' => 93],
            ['Date' => '2009-11-01', 'Rainfall' => 102],
            ['Date' => '2009-12-01', 'Rainfall' => 115],

            // =======================================================
            // 2010
            ['Date' => '2010-01-01', 'Rainfall' => 63],
            ['Date' => '2010-02-01', 'Rainfall' => 54],
            ['Date' => '2010-03-01', 'Rainfall' => 64],
            ['Date' => '2010-04-01', 'Rainfall' => 54],
            ['Date' => '2010-05-01', 'Rainfall' => 79],
            ['Date' => '2010-06-01', 'Rainfall' => 87],
            ['Date' => '2010-07-01', 'Rainfall' => 90],
            ['Date' => '2010-08-01', 'Rainfall' => 72],
            ['Date' => '2010-09-01', 'Rainfall' => 92],
            ['Date' => '2010-10-01', 'Rainfall' => 102],
            ['Date' => '2010-11-01', 'Rainfall' => 118],
            ['Date' => '2010-12-01', 'Rainfall' => 130],

            // =======================================================
            // 2011
            ['Date' => '2011-01-01', 'Rainfall' => 65],
            ['Date' => '2011-02-01', 'Rainfall' => 63],
            ['Date' => '2011-03-01', 'Rainfall' => 57],
            ['Date' => '2011-04-01', 'Rainfall' => 64],
            ['Date' => '2011-05-01', 'Rainfall' => 75],
            ['Date' => '2011-06-01', 'Rainfall' => 79],
            ['Date' => '2011-07-01', 'Rainfall' => 90],
            ['Date' => '2011-08-01', 'Rainfall' => 75],
            ['Date' => '2011-09-01', 'Rainfall' => 69],
            ['Date' => '2011-10-01', 'Rainfall' => 97],
            ['Date' => '2011-11-01', 'Rainfall' => 107],
            ['Date' => '2011-12-01', 'Rainfall' => 107],

            // =======================================================
            // 2012
            ['Date' => '2012-01-01', 'Rainfall' => 61],
            ['Date' => '2012-02-01', 'Rainfall' => 52],
            ['Date' => '2012-03-01', 'Rainfall' => 75],
            ['Date' => '2012-04-01', 'Rainfall' => 62],
            ['Date' => '2012-05-01', 'Rainfall' => 72],
            ['Date' => '2012-06-01', 'Rainfall' => 83],
            ['Date' => '2012-07-01', 'Rainfall' => 90],
            ['Date' => '2012-08-01', 'Rainfall' => 90],
            ['Date' => '2012-09-01', 'Rainfall' => 66],
            ['Date' => '2012-10-01', 'Rainfall' => 93],
            ['Date' => '2012-11-01', 'Rainfall' => 98],
            ['Date' => '2012-12-01', 'Rainfall' => 103],

            // =======================================================
            // 2013
            ['Date' => '2013-01-01', 'Rainfall' => 66],
            ['Date' => '2013-02-01', 'Rainfall' => 57],
            ['Date' => '2013-03-01', 'Rainfall' => 60],
            ['Date' => '2013-04-01', 'Rainfall' => 59],
            ['Date' => '2013-05-01', 'Rainfall' => 68],
            ['Date' => '2013-06-01', 'Rainfall' => 78],
            ['Date' => '2013-07-01', 'Rainfall' => 88],
            ['Date' => '2013-08-01', 'Rainfall' => 88],
            ['Date' => '2013-09-01', 'Rainfall' => 81],
            ['Date' => '2013-10-01', 'Rainfall' => 99],
            ['Date' => '2013-11-01', 'Rainfall' => 109],
            ['Date' => '2013-12-01', 'Rainfall' => 111],

            // =======================================================
            // 2014
            ['Date' => '2014-01-01', 'Rainfall' => 66],
            ['Date' => '2014-02-01', 'Rainfall' => 55],
            ['Date' => '2014-03-01', 'Rainfall' => 60],
            ['Date' => '2014-04-01', 'Rainfall' => 60],
            ['Date' => '2014-05-01', 'Rainfall' => 75],
            ['Date' => '2014-06-01', 'Rainfall' => 92],
            ['Date' => '2014-07-01', 'Rainfall' => 89],
            ['Date' => '2014-08-01', 'Rainfall' => 87],
            ['Date' => '2014-09-01', 'Rainfall' => 70],
            ['Date' => '2014-10-01', 'Rainfall' => 89],
            ['Date' => '2014-11-01', 'Rainfall' => 106],
            ['Date' => '2014-12-01', 'Rainfall' => 114],

            // =======================================================
            // 2015
            ['Date' => '2015-01-01', 'Rainfall' => 69],
            ['Date' => '2015-02-01', 'Rainfall' => 50],
            ['Date' => '2015-03-01', 'Rainfall' => 77],
            ['Date' => '2015-04-01', 'Rainfall' => 53],
            ['Date' => '2015-05-01', 'Rainfall' => 78],
            ['Date' => '2015-06-01', 'Rainfall' => 91],
            ['Date' => '2015-07-01', 'Rainfall' => 85],
            ['Date' => '2015-08-01', 'Rainfall' => 82],
            ['Date' => '2015-09-01', 'Rainfall' => 70],
            ['Date' => '2015-10-01', 'Rainfall' => 92],
            ['Date' => '2015-11-01', 'Rainfall' => 110],
            ['Date' => '2015-12-01', 'Rainfall' => 102],

            // =======================================================
            // 2016
            ['Date' => '2016-01-01', 'Rainfall' => 60],
            ['Date' => '2016-02-01', 'Rainfall' => 57],
            ['Date' => '2016-03-01', 'Rainfall' => 65],
            ['Date' => '2016-04-01', 'Rainfall' => 68],
            ['Date' => '2016-05-01', 'Rainfall' => 71],
            ['Date' => '2016-06-01', 'Rainfall' => 78],
            ['Date' => '2016-07-01', 'Rainfall' => 94],
            ['Date' => '2016-08-01', 'Rainfall' => 79],
            ['Date' => '2016-09-01', 'Rainfall' => 71],
            ['Date' => '2016-10-01', 'Rainfall' => 102],
            ['Date' => '2016-11-01', 'Rainfall' => 92],
            ['Date' => '2016-12-01', 'Rainfall' => 111],

            // =======================================================
            // 2017
            ['Date' => '2017-01-01', 'Rainfall' => 66],
            ['Date' => '2017-02-01', 'Rainfall' => 59],
            ['Date' => '2017-03-01', 'Rainfall' => 64],
            ['Date' => '2017-04-01', 'Rainfall' => 53],
            ['Date' => '2017-05-01', 'Rainfall' => 78],
            ['Date' => '2017-06-01', 'Rainfall' => 81],
            ['Date' => '2017-07-01', 'Rainfall' => 91],
            ['Date' => '2017-08-01', 'Rainfall' => 87],
            ['Date' => '2017-09-01', 'Rainfall' => 67],
            ['Date' => '2017-10-01', 'Rainfall' => 96],
            ['Date' => '2017-11-01', 'Rainfall' => 101],
            ['Date' => '2017-12-01', 'Rainfall' => 106],

            // =======================================================
            // 2018
            ['Date' => '2018-01-01', 'Rainfall' => 74],
            ['Date' => '2018-02-01', 'Rainfall' => 57],
            ['Date' => '2018-03-01', 'Rainfall' => 64],
            ['Date' => '2018-04-01', 'Rainfall' => 63],
            ['Date' => '2018-05-01', 'Rainfall' => 70],
            ['Date' => '2018-06-01', 'Rainfall' => 84],
            ['Date' => '2018-07-01', 'Rainfall' => 96],
            ['Date' => '2018-08-01', 'Rainfall' => 81],
            ['Date' => '2018-09-01', 'Rainfall' => 75],
            ['Date' => '2018-10-01', 'Rainfall' => 97],
            ['Date' => '2018-11-01', 'Rainfall' => 104],
            ['Date' => '2018-12-01', 'Rainfall' => 119],

            // =======================================================
            // 2019
            ['Date' => '2019-01-01', 'Rainfall' => 64],
            ['Date' => '2019-02-01', 'Rainfall' => 51],
            ['Date' => '2019-03-01', 'Rainfall' => 66],
            ['Date' => '2019-04-01', 'Rainfall' => 56],
            ['Date' => '2019-05-01', 'Rainfall' => 75],
            ['Date' => '2019-06-01', 'Rainfall' => 82],
            ['Date' => '2019-07-01', 'Rainfall' => 91],
            ['Date' => '2019-08-01', 'Rainfall' => 89],
            ['Date' => '2019-09-01', 'Rainfall' => 70],
            ['Date' => '2019-10-01', 'Rainfall' => 102],
            ['Date' => '2019-11-01', 'Rainfall' => 99],
            ['Date' => '2019-12-01', 'Rainfall' => 124],

            // =======================================================
            // 2020
            ['Date' => '2020-01-01', 'Rainfall' => 68],
            ['Date' => '2020-02-01', 'Rainfall' => 51],
            ['Date' => '2020-03-01', 'Rainfall' => 65],
            ['Date' => '2020-04-01', 'Rainfall' => 62],
            ['Date' => '2020-05-01', 'Rainfall' => 74],
            ['Date' => '2020-06-01', 'Rainfall' => 84],
            ['Date' => '2020-07-01', 'Rainfall' => 92],
            ['Date' => '2020-08-01', 'Rainfall' => 85],
            ['Date' => '2020-09-01', 'Rainfall' => 66],
            ['Date' => '2020-10-01', 'Rainfall' => 87],
            ['Date' => '2020-11-01', 'Rainfall' => 98],
            ['Date' => '2020-12-01', 'Rainfall' => 114],

            // =======================================================
            // 2021
            ['Date' => '2021-01-01', 'Rainfall' => 92],
            ['Date' => '2021-02-01', 'Rainfall' => 78],
            ['Date' => '2021-03-01', 'Rainfall' => 88],
            ['Date' => '2021-04-01', 'Rainfall' => 81],
            ['Date' => '2021-05-01', 'Rainfall' => 95],
            ['Date' => '2021-06-01', 'Rainfall' => 110],
            ['Date' => '2021-07-01', 'Rainfall' => 121],
            ['Date' => '2021-08-01', 'Rainfall' => 118],
            ['Date' => '2021-09-01', 'Rainfall' => 105],
            ['Date' => '2021-10-01', 'Rainfall' => 129],
            ['Date' => '2021-11-01', 'Rainfall' => 133],
            ['Date' => '2021-12-01', 'Rainfall' => 140],

            // =======================================================
            // 2022
            ['Date' => '2022-01-01', 'Rainfall' => 58],
            ['Date' => '2022-02-01', 'Rainfall' => 50],
            ['Date' => '2022-03-01', 'Rainfall' => 73],
            ['Date' => '2022-04-01', 'Rainfall' => 63],
            ['Date' => '2022-05-01', 'Rainfall' => 78],
            ['Date' => '2022-06-01', 'Rainfall' => 99],
            ['Date' => '2022-07-01', 'Rainfall' => 93],
            ['Date' => '2022-08-01', 'Rainfall' => 91],
            ['Date' => '2022-09-01', 'Rainfall' => 75],
            ['Date' => '2022-10-01', 'Rainfall' => 98],
            ['Date' => '2022-11-01', 'Rainfall' => 114],
            ['Date' => '2022-12-01', 'Rainfall' => 102],

            // =======================================================
            // 2023
            ['Date' => '2023-01-01', 'Rainfall' => 61],
            ['Date' => '2023-02-01', 'Rainfall' => 54],
            ['Date' => '2023-03-01', 'Rainfall' => 68],
            ['Date' => '2023-04-01', 'Rainfall' => 60],
            ['Date' => '2023-05-01', 'Rainfall' => 87],
            ['Date' => '2023-06-01', 'Rainfall' => 71],
            ['Date' => '2023-07-01', 'Rainfall' => 93],
            ['Date' => '2023-08-01', 'Rainfall' => 77],
            ['Date' => '2023-09-01', 'Rainfall' => 68],
            ['Date' => '2023-10-01', 'Rainfall' => 100],
            ['Date' => '2023-11-01', 'Rainfall' => 100],
            ['Date' => '2023-12-01', 'Rainfall' => 105],

            // =======================================================
            // 2024
            ['Date' => '2024-01-01', 'Rainfall' => 61],
            ['Date' => '2024-02-01', 'Rainfall' => 58],
            ['Date' => '2024-03-01', 'Rainfall' => 66],
            ['Date' => '2024-04-01', 'Rainfall' => 61],
            ['Date' => '2024-05-01', 'Rainfall' => 75],
            ['Date' => '2024-06-01', 'Rainfall' => 77],
            ['Date' => '2024-07-01', 'Rainfall' => 101],
            ['Date' => '2024-08-01', 'Rainfall' => 88],
            ['Date' => '2024-09-01', 'Rainfall' => 60],
            ['Date' => '2024-10-01', 'Rainfall' => 96],
            ['Date' => '2024-11-01', 'Rainfall' => 97],
            ['Date' => '2024-12-01', 'Rainfall' => 114],

            // =======================================================
            // 2025 (Dit is de laatste observatie die u levert)
            ['Date' => '2025-01-01', 'Rainfall' => 72],
            ['Date' => '2025-02-01', 'Rainfall' => 62],
            ['Date' => '2025-03-01', 'Rainfall' => 70],
            ['Date' => '2025-04-01', 'Rainfall' => 55],
            ['Date' => '2025-05-01', 'Rainfall' => 68],
            ['Date' => '2025-06-01', 'Rainfall' => 74],
            ['Date' => '2025-07-01', 'Rainfall' => 85],
            ['Date' => '2025-08-01', 'Rainfall' => 79],
            ['Date' => '2025-09-01', 'Rainfall' => 71],
            ['Date' => '2025-10-01', 'Rainfall' => 90],
            ['Date' => '2025-11-01', 'Rainfall' => 94],
            ['Date' => '2025-12-01', 'Rainfall' => 108]
        ];

        // 2. Data naar JSON converteren
        $jsonPayload = json_encode($historicalDataArray);

        // 3. De Python Microservice aanroepen (de logica verandert niet)
        $pythonApiUrl = 'http://localhost:6942/api/forecast';

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json'
            ])->post($pythonApiUrl, [
                        'data' => $jsonPayload
                    ]);

            $forecastData = $response->json();

            if (isset($forecastData['error'])) {
                return view('forcasting.error', ['message' => 'Voorspelling mislukt: ' . $forecastData['error']]);
            }

            // 4. De gestructureerde data ophalen (Deze functie blijft hetzelfde!)
            $processedForecast = $forecastData;

            $currentMonth = now()->month;

            $season = match (true) {
                in_array($currentMonth, [12, 1, 2]) => 'winter',
                in_array($currentMonth, [3, 4, 5]) => 'spring',
                in_array($currentMonth, [6, 7, 8]) => 'summer',
                default => 'autumn',
            };

            $seasonMonths = match ($season) {
                'winter' => [12, 1, 2],
                'spring' => [3, 4, 5],
                'summer' => [6, 7, 8],
                'autumn' => [9, 10, 11],
            };

            $seasonData = collect($processedForecast)->filter(function ($item) use ($seasonMonths) {
                return in_array($item['month'], $seasonMonths);
            });

            $seasonRainfall = $seasonData->sum('rainfall');

            $thresholds = [
                'winter' => 300,
                'spring' => 250,
                'summer' => 260,
                'autumn' => 280,
            ];

            $floodRisk = $seasonRainfall >= $thresholds[$season];

            $suggestedMaterials = collect();

            if ($floodRisk) {

                $suggestedMaterials = \App\Models\FloodMaterial::with('material')
                    ->get()
                    ->filter(function ($item) {
                        return $item->material !== null; //safety check
                    })
                    ->map(function ($item) {
                        return [
                            'id' => $item->material->id,
                            'productname' => $item->material->productname,
                        ];
                    })
                    ->values();
            }

            session([
                'floodRisk' => $floodRisk,
            ]);

            return view('forecast.forecast', compact('processedForecast'));

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
