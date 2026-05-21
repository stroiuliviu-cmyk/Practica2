<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comenzi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')
                ->constrained('clienti')
                ->cascadeOnDelete();
            $table->foreignId('produs_id')
                ->constrained('produse')
                ->cascadeOnDelete();
            $table->integer('cantitate')->default(1);
            $table->text('observatii')->nullable();
            $table->enum('status', ['noua', 'in_procesare', 'finalizata', 'anulata'])
                ->default('noua');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comenzi');
    }
};
