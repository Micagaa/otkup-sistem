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
        Schema::disableForeignKeyConstraints();

        Schema::create('serija_prerades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('otkup_id')->constrained();
            $table->enum('faza', ['ciscenje', 'sortiranje', 'susenje', 'hladjenje', 'pakovanje'])->default('ciscenje');
            $table->enum('status_kvaliteta', ['na_kontroli', 'ispravno', 'neispravno'])->default('na_kontroli');
            $table->text('napomena_kvaliteta')->nullable();
            $table->date('datum_pocetka')->nullable();
            $table->date('datum_zavrsetka')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('serija_prerades');
    }
};
