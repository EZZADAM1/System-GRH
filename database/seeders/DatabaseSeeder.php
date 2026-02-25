<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run()
{
    // 1. D'abord on crée les départements
    $this->call(DepartmentSeeder::class);

    // 2. Ensuite on crée 10 employés fictifs
    \App\Models\Employee::factory(10)->create();
    
    // 3. Optionnel : Créer un Admin spécifique pour toi tester
    \App\Models\User::factory()->create([
        'name' => 'Admin User',
        'email' => 'admin@grh.com',
        'password' => bcrypt('password'), // Mot de passe facile pour tester
    ]);
}
}
