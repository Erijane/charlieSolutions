<?php

namespace App\Http;

use App\Http\Controllers\Controller;
use App\Models\CharlieMessages;
use Carbon\Carbon;
use Illuminate\View\View;

class BuildingSiteCharlieController extends Controller
{
    /**
     * @return View
     */
    public function show(): View
    {
        $data = CharlieMessages::orderBy('time', 'desc')->get();
        $dataToShow = [];

        if ($data->isEmpty()) {
            return view('buildingSiteCharlie', ['dataToShow' =>$dataToShow]);
        }

        foreach ($data as &$datum) {
            $distanceTrackerToBuildingSite =  $this->distanceBetweenTrackerAndBuildingSite($datum['latitude'], $datum['longitude']);
            $time = Carbon::parse($datum['time']);

            foreach (json_decode($datum['RSSI'], true) as $sensor => $RSSI) {
                $distanceTrackerToSensor = $this->distanceBetweenTrackerAndSensor($RSSI);
                $sensors[$sensor] = [
                        'distanceTrackerToSensor' => $distanceTrackerToSensor,
                        'distanceMinBetweenBuildingSiteAndSensor' => $distanceTrackerToBuildingSite - $distanceTrackerToSensor,
                        'distanceMaxBetweenBuildingSiteAndSensor' => $distanceTrackerToBuildingSite + $distanceTrackerToSensor,
                ];
            }
            $dataToShow[$time->format('Y-m-d')][$time->format('H:i:s')] =
                [
                    'topic' => $datum['topic'],
                    'distanceTrackerToBuildingSite' => $distanceTrackerToBuildingSite,
                    'sensors' => $sensors
                ];
            $sensors = [];
        }

        return view('buildingSiteCharlie', ['dataToShow' =>$dataToShow]);
    }

    /**
     * @param $latitude
     * @param $longitude
     * @return float
     */
    private function distanceBetweenTrackerAndBuildingSite($latitude, $longitude): float
    {
        $originalLatitude = 50.6337848;
        $originalLongitude =  3.0217842;
        $pi80 = M_PI / 180;

        $originalLatitude *= $pi80;
        $originalLongitude *= $pi80;
        $latitude *= $pi80;
        $longitude *= $pi80;

        $r = 6372.797; // mean radius of the earth in km
        $dlat = $latitude - $originalLatitude;
        $dlng = $longitude - $originalLongitude;
        $a = sin($dlat / 2) * sin($dlat / 2) + cos($originalLatitude) * cos($latitude) * sin(
                $dlng / 2) * sin($dlng / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $km = $r * $c;

        return $km * 1000;
    }

    /**
     * @param $RSSI
     * @return float
     */
    private function distanceBetweenTrackerAndSensor($RSSI): float
    {
        return 10^((ABS($RSSI)-(-70))/10*2);
    }
}
