<?php

namespace App\Console\Commands;

use App\Models\CharlieMessages;
use App\Models\CharlieMqttMessages;
use Illuminate\Console\Command;

class convertData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:convert-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     * @throws \Exception
     */
    public function handle()
    {
        $data = CharlieMqttMessages::all();
        $trackers = [];
        $sensors = [];

        // In first, we create two array, one with all tracker data (only with valid position),
        // and other one with sensor data
        /** @var CharlieMqttMessages $datum */
        foreach ($data as $datum) {
            if ($datum->isTracker())
            {
                if (! $datum->positionIsValid()) {
                    continue;
                }
                $trackers[] = [
                    'topic'     => $datum->getTopic(),
                    'battery'   => json_encode($datum->getTrackerBattery()),
                    'longitude' => $datum->getTrackerLongitude(),
                    'latitude'  => $datum->getTrackerLatitude(),
                    'idFrame'   => $datum->getTrackerIdFrame(),
                    'time'      => $datum->getTrackerTime(),
                ];
            }

            if ($datum->isSensor()) {
                $sensors[] = [
                    'topic'        => $datum->getTopic(),
                    'idFrame'      => $datum->getSensorIdFrame(),
                    'list'         => $datum->getSensorList(),
                    'RSSI'         => $datum->getRSSI(),
                ];
            }
       }

       foreach ($trackers as &$tracker) {
           foreach ($sensors as $key => $sensor) {
               if ($sensor['topic'] === $tracker['topic'] && $sensor['idFrame'] === $tracker['idFrame']) {
                   $tracker['sensorList'] = json_encode($sensor['list']);
                   $tracker['RSSI'] = json_encode($sensor['RSSI']);
                   unset($sensors[$key]);
               }
           }

           if (! empty($tracker['sensorList'])) {
               CharlieMessages::insert($tracker);
           }
       }
    }
}
