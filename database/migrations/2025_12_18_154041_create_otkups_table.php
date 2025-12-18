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

        Schema::create('otkups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dobavljac_id')->constrained();
            $table->string('vrsta_ploda');
            $table->decimal('kolicina_kg', 8, 2);
            $table->decimal('cena_po_kg', 10, 2);
            $table->date('datum_otkupa');
            $table->enum('status_isplate', ["na_cekanju","isplaceno"])->default('na_cekanju');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('otkups');
    }
};
