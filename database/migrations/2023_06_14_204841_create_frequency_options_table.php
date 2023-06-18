<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrequencyOptionsTable extends Migration
{
    public function up()
    {
        Schema::create('frequency_options', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // Insert frequency options
        DB::table('frequency_options')->insert([
            ['name' => 'Daily'],
            ['name' => 'Weekly'],
            ['name' => 'Monthly'],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('frequency_options');
    }
}
