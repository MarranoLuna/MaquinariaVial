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
        Schema::create('machines', function (Blueprint $table) {
            $table->id("id_machine");
            $table->string("serial_number")->unique();
            $table->foreignId("id_type")->constrained("machine_types", "id_type");
            $table->foreignId("id_brand")->constrained("machine_brands", "id_brand");
            $table->integer("kilometers");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('machines');
    }
};
