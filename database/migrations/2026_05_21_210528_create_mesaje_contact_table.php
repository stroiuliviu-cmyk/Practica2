<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mesaje_contact', function (Blueprint $table) {
            $table->id();
            $table->string('nume', 150);
            $table->string('email', 150);
            $table->string('telefon', 30)->nullable();
            $table->string('subiect', 200);
            $table->text('mesaj');
            $table->boolean('citit')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mesaje_contact');
    }
};
