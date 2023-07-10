<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CharlieMqttMessages extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'verification_date' => 'datetime',
    ];

    public function isTracker(bool $throwable = false): bool
    {
        $message = json_decode($this['message'], true);

        if (is_null($message)) {
            return $throwable ? throw new \Exception('This object is not a Tracker') : false;
        }

        if (! str_contains($message['s'], 'GT')) {
            return $throwable ? throw new \Exception('This object is not a Tracker') : false;
        }

        return true;
    }

    public function isSensor(bool $throwable = false): bool
    {
        $message = json_decode($this['message'], true);
        if (is_null($message)) {
            return $throwable ? throw new \Exception('This object is not a Sensor') : false;
        }

        if (! str_contains($message['s'], 'CP')) {
            return $throwable ? throw new \Exception('This object is not a Sensor') : false;
        }

        return true;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getMessage(): mixed
    {
        return json_decode($this['message'], true);
    }
    /**
     * @return bool
     * @throws \Exception
     */
    public function positionIsValid() : bool
    {
        $this->isTracker(true);
        $message = $this->getMessage();

        return $message['v']['GPS']['validPosition'] ?? 0;
    }

    /**
     * @return int|null
     * @throws \Exception
     */
    public function getTopic(): int|null
    {
        return $this['topic'] ?? null;
    }

    /**
     * @return \stdClass|null
     * @throws \Exception
     */
    public function getTrackerBattery(): array|null
    {
        $this->isTracker(true);
        $message = $this->getMessage();

        return $message['v']['battery'] ?? null;
    }

    /**
     * @return int|null
     * @throws \Exception
     */
    public function getTrackerIdFrame(): int|null
    {
        $this->isTracker(true);
        $message = $this->getMessage();
        $str = explode(':', $message['v']['ID_FRAME']['value']);

        return  $str[1] ?? null;
    }

    /**
     * @return float|null
     * @throws \Exception
     */
    public function getTrackerLatitude(): float|null
    {
        $this->isTracker(true);
        $message = $this->getMessage();

        return $message['loc'][0] ?? null;
    }

    /**
     * @return float|null
     * @throws \Exception
     */
    public function getTrackerLongitude(): float|null
    {
        $this->isTracker(true);
        $message = $this->getMessage();

        return $message['loc'][1] ?? null;
    }

    /**
     * @return mixed|null
     * @throws \Exception
     */
    public function getTrackerTime(): Carbon|null {
        $this->isTracker(true);
        $message = $this->getMessage();

        return Carbon::parse($message['ts']) ?? null;

    }

    /**
     * @return int|null
     * @throws \Exception
     */
    public function getSensorIdFrame(): int|null
    {
        $this->isSensor(true);
        $message = $this->getMessage();
        $str = explode(':', $message['ID_FRAME']);

       return $str[1] ?? null;
    }

    /**
     * @param int $infoPlace
     * @return array|string[]
     * @throws \Exception
     */
    public function filterBlePayload(): array
    {
        $this->isSensor(true);
        $message = $this->getMessage();

        $blePayload = str_replace('C ID', '', $message['ble_payload']);
        $blePayload = str_replace('L ID', '', $blePayload);

        return str_replace('P ID', '', $blePayload);
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getSensorList(): array
    {
        $blePayload = $this->filterBlePayload();

        return array_map(function($blePayload) {
            $info = explode(';', $blePayload);

            return trim($info[0]);
        }, $blePayload);
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getRSSI(): array
    {
        $blePayload = $this->filterBlePayload();
        $result = [];
        array_walk($blePayload, function($blePayload) use (&$result) {
            $info = explode(';', $blePayload);
            $result[trim($info[0])] = trim($info[3]);
        });

        return $result;
    }
}

