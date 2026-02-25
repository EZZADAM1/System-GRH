<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    public function run()
    {
        $departments = [
            ['name' => 'Ressources Humaines', 'code' => 'RH'],
            ['name' => 'Informatique (IT)', 'code' => 'IT'],
            ['name' => 'Marketing', 'code' => 'MKT'],
            ['name' => 'Finance', 'code' => 'FIN'],
        ];

        foreach ($departments as $dept) {
            Department::create($dept);
        }
    }
}