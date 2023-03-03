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
        Schema::create('fronts', function (Blueprint $table) {
            $table->id();
            $table->text('aaa', 30);
            $table->unsignedTinyInteger('rating');
            // cia yra many to many rysys, todel reikia to ismokti, pradzioj bandyti 3 lentele tureti kur abi lenteles jungiu i vidurine
            // $table->foreign('aaa')->references('name')->on('dishes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fronts');
    }
};
