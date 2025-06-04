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
        Schema::create('service_machines', function (Blueprint $table) {
            $table->id("id_service_machine");
            $table->foreignId("id_service")->constrained("services", "id_service");
            $table->foreignId("id_machine")->constrained("machines", "id_machine");
            $table->string("description");
            $table->integer("kilometers_at_service");
            $table->date("start_date");
            $table->date("end_date")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_machines');
    }
};
