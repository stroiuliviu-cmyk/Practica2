<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categorii', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 100)->unique();
            $table->string('denumire', 150);
            $table->string('descriere_scurta', 300)->nullable();
            $table->text('descriere_completa')->nullable();
            $table->string('imagine', 255)->nullable();
            $table->integer('ordine_afisare')->default(0);
            $table->boolean('activ')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categorii');
    }
};
