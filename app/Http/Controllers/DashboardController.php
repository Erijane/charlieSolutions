<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\CharlieMessages;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function show(): View
    {
        $data = CharlieMessages::orderBy('time')->get();

        if ($data->isEmpty()) {
            return view('dashboard', ['sensorLists' => []]);
        }
        $day = Carbon::parse($data[0]['time'])->format('Y-m-d');
        $sensorLists = [];
        $tmpSensorLists = [];
        foreach ($data as &$datum) {
            $time = Carbon::parse($datum['time']);
            $datum['day'] = $time->format('Y-m-d');
            $datum['hours'] = $time->format('H:i:s');

            if ($day === $datum['day']) {
                $tmpSensorLists = array_merge($tmpSensorLists, json_decode($datum['sensorList']));
            } else {
               $sensorLists[$day] = array_count_values($tmpSensorLists);
               $tmpSensorLists = [];
               $tmpSensorLists = array_merge($tmpSensorLists, json_decode($datum['sensorList']));
            }
            $day = $datum['day'];
        }

        return view('dashboard', ['sensorLists' => $sensorLists]);
    }
}
