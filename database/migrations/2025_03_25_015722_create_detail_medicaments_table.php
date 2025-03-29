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
        Schema::create('detail_medicaments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medicament_id')->constraind();
            $table->integer('qte_donnee');
            $table->text('commentaire');
            $table->foreignId('ordonnance_id')->constraind();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_medicaments');
    }
};
