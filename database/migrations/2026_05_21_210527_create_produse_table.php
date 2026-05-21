<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produse', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categorie_id')
                ->constrained('categorii')
                ->cascadeOnDelete();
            $table->string('denumire', 200);
            $table->text('descriere')->nullable();
            $table->string('imagine', 255)->nullable();
            $table->decimal('pret_de_la', 8, 2)->nullable();
            $table->json('caracteristici')->nullable();
            $table->boolean('activ')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produse');
    }
};
