<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    public function definition()
    {
        return [
            // On prend un département au hasard
            'department_id' => Department::inRandomOrder()->first()->id,
            
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'matricule' => 'EMP-' . $this->faker->unique()->numberBetween(1000, 9999),
            'email_professional' => $this->faker->unique()->companyEmail(),
            'phone' => $this->faker->phoneNumber(),
            'birth_date' => $this->faker->date('Y-m-d', '-20 years'), // Au moins 20 ans
            'hired_at' => $this->faker->date('Y-m-d', '-1 year'),
            'salary' => $this->faker->numberBetween(2500, 6000), // Salaire entre 2500 et 6000
        ];
    }
}