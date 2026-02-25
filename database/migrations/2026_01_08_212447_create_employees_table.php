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
    Schema::create('employees', function (Blueprint $table) {
        $table->id();
        // Lien avec le compte utilisateur (Login)
        $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
        
        // Lien avec le département
        $table->foreignId('department_id')->constrained()->onDelete('restrict');

        // Infos Personnelles
        $table->string('first_name');
        $table->string('last_name');
        $table->string('matricule')->unique(); // ID unique (ex: EMP-2024-001)
        $table->string('email_professional')->unique();
        $table->string('phone')->nullable();
        $table->date('birth_date')->nullable();
        
        // Infos Contrat & Paie
        $table->date('hired_at'); // Date d'embauche
        $table->decimal('salary', 10, 2)->nullable(); // Salaire de base
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
