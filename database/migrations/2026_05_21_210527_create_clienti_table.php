<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clienti', function (Blueprint $table) {
            $table->id();
            $table->string('nume', 100);
            $table->string('prenume', 100);
            $table->string('telefon', 30);
            $table->string('email', 150);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clienti');
    }
};
