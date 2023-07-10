<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('charlie_messages', function (Blueprint $table) {
            $table->id();
            $table->string('topic', 255);
            $table->text('battery');
            $table->float('latitude',10,7);
            $table->float('longitude',10,7);
            $table->integer('idFrame');
            $table->datetime('time');
            $table->longText('sensorList');
            $table->longText('RSSI');
            $table->timestamps();

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('charlie_messages');
    }
};
