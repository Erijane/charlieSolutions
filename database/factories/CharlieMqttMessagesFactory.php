<?php

namespace Database\Factories;

use App\Models\CharlieMqttMessages;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CharlieMqttMessagesFactory extends Factory
{
    protected $model = CharlieMqttMessages::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->unique()->uuid(),
            'topic' => '359159972805031',
            'traitement' => 1,
            'verification_date' => null,
            'message' => null
        ];
    }

    public function tracker(): static
    {
        return $this->state(fn (array $attributes) => [
            'message' => '{ "s": "GT:359159972805031", "ts": "2023-02-13T17:46:45.0Z", "m": "init_model", "loc": [ 50.632644, 3.057317 ], "v": { "ID_FRAME": { "value": "id:901" }, "temperature": { "value": 18, "unit": "degC" }, "battery": { "value": 3.564000, "unit": "V", "remaining": 93 }, "GPS": { "validPosition": 1, "speed": { "value": 0.000000, "unit": "kmh" }, "onMove": 128 }, "network": { "rsrp": 31, "rsrq": 99 } } }',
        ]);
    }

    public function sensor(): static
    {
        return $this->state(fn (array $attributes) => [
            'message' => '{ "s": "CP:359159972805031","ID_FRAME": "id:901","ble_payload": [ "C ID 003F3F;0;0;-60"]}'
        ]);
    }

}
