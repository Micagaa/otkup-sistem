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

        Schema::create('zalihas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('serija_prerade_id')->constrained();
            $table->string('vrsta_proizvoda');
            $table->decimal('kolicina_kg', 8, 2);
            $table->date('rok_upotrebe')->nullable();
            $table->string('pozicija')->nullable();
            $table->date('datum_prijema');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zalihas');
    }
};
