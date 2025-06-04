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
        Schema::create('assignments', function (Blueprint $table) {
            $table->id("id_assignment"); // ID de esta tabla
            $table->foreignId("id_construction")->constrained("constructions", "id_construction");
            $table->foreignId("id_machine")->constrained("machines", "id_machine");
            $table->date("start_date");
            $table->date("end_date")->nullable();
            $table->foreignId("id_reason")->nullable()->constrained("end_reasons", "id_reason");
            $table->integer("kilometers");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};
