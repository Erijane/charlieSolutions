<?php

namespace Tests\Unit;

use App\Models\CharlieMqttMessages;
use PHPUnit\Framework\TestCase;

class CharlieMqttMessagesTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_is_tracker_true(): void
    {
        $charlieMqttMessages = CharlieMqttMessages::factory()->tracker()->make();

        $this->assertTrue($charlieMqttMessages->isTracker());
    }

    public function test_is_tracker_false(): void
    {
        $charlieMqttMessages = CharlieMqttMessages::factory()->sensor()->make();

        $this->assertFalse($charlieMqttMessages->isTracker());
    }

    public function test_is_tracker_return_throwable(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('This object is not a Tracker');

        $charlieMqttMessages = CharlieMqttMessages::factory()->sensor()->make();
        $charlieMqttMessages->isTracker(true);
    }

    public function test_is_sensor_true(): void
    {
        $charlieMqttMessages = CharlieMqttMessages::factory()->sensor()->make();

        $this->assertTrue($charlieMqttMessages->isSensor());
    }

    public function test_is_sensor_false(): void
    {
        $charlieMqttMessages = CharlieMqttMessages::factory()->tracker()->make();

        $this->assertFalse($charlieMqttMessages->isSensor());
    }

    public function test_is_sensor_return_throwable(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('This object is not a Sensor');

        $charlieMqttMessages = CharlieMqttMessages::factory()->tracker()->make();
        $charlieMqttMessages->isSensor(true);
    }

    public function test_get_tracker_id_frame() {
        $charlieMqttMessages = CharlieMqttMessages::factory()->tracker()->make();
        $this->assertEquals('901', $charlieMqttMessages->getTrackerIdFrame());
    }

    public function test_get_sensor_id_frame() {
        $charlieMqttMessages = CharlieMqttMessages::factory()->sensor()->make();
        $this->assertEquals('901', $charlieMqttMessages->getSensorIdFrame());
    }

    public function test_get_sensor_list() {
        $charlieMqttMessages = CharlieMqttMessages::factory()->sensor()->make();
        $this->assertEquals(['003F3F'], $charlieMqttMessages->getSensorList());
    }

    public function test_get_sensor_Rssi() {
        $charlieMqttMessages = CharlieMqttMessages::factory()->sensor()->make();
        $this->assertEquals(['003F3F' => '-60'], $charlieMqttMessages->getRSSI());
    }
}
