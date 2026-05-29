<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('galerie', function (Blueprint $table) {
            $table->id();
            $table->string('titlu', 200);
            $table->string('descriere', 500)->nullable();
            $table->string('imagine', 255);
            $table->foreignId('categorie_id')
                ->nullable()
                ->constrained('categorii')
                ->nullOnDelete();
            $table->integer('ordine_afisare')->default(0);
            $table->boolean('activ')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galerie');
    }
};
