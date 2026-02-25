<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            
            // Lien avec la table employees (Si on supprime l'employé, on supprime ses congés)
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            
            // Les dates du congé
            $table->date('start_date');
            $table->date('end_date');
            
            // Type (ex: Maladie, Payé...) et Motif
            $table->string('type')->default('conge_paye'); 
            $table->text('reason')->nullable();
            
            // Statut : pending (en attente), approved (validé), rejected (refusé)
            $table->string('status')->default('pending');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaves');
    }
};
