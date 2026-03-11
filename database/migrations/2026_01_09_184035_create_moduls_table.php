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
        Schema::create('moduls', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->integer('hores');
            $table->foreignId('professor_id')->nullable()->constrained('professors')->nullOnDelete();
            $table->foreignId('departament_id') ->nullable() ->constrained('departaments') ->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moduls');
    }
};
