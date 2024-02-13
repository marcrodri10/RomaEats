<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $arrayRoles = ['admin', 'user'];

        foreach($arrayRoles as $role){
            $roleClass = new Role;
            $roleClass->role_name = $role;
            $roleClass->save();
        }

    }
}
