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
        Schema::create('matricules', function (Blueprint $table) {
            $table->id();
            $table->foreignId("alumne_id")->constrained("alumnes")->OnDelete("cascade");
            $table->foreignId("modul_id")->constrained("moduls")->OnDelete("cascade");
            $table->decimal("nota",5,2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matricules');
    }
};
