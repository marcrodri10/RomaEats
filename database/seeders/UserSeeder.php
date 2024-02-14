<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $adminUser = new User;
        $adminUser->name = 'marc.admin';
        $adminUser->surname = "Admin";
        $adminUser->password = Hash::make('12345');
        $adminUser->email = 'marc.admin@gmail.com';
        $adminUser->role_id = 1;
        $adminUser->save();
    }
}
