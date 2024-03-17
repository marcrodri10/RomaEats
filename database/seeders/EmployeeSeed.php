<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmployeeSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Crear 5 usuarios
        $users = User::factory()->count(5)->create();

        // Para cada usuario, crear un empleado asociado
        foreach ($users as $user) {
            // Crear un empleado utilizando el factory y asignar el user_id
            $employee = Employee::factory()->create([
                'user_id' => $user->id,
            ]);
        }
    }
}
