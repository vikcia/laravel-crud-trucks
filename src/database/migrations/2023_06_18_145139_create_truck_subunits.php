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
        Schema::create('truck_subunits', function (Blueprint $table) {
            $table->id();

            $table->foreignId('trucks_id')->nullable();
            
            // $table->foreignId('trucks_id')->constrained();
            $table->string('main_truck', 255);
            $table->string('subunit');
            $table->string('start_date');
            $table->string('end_date');
            $table->timestamps();
 
            // $table->foreign('trucks_id')->references('id')->on('trucks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('truck_subunits');
    }
};
