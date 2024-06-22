<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $admin = User::create([
            "name" => "Shadab",
            "email" => "shadab772684@gmail.com",
            "password" => bcrypt("test"),
        ]);
        $admin->assignRole("admin");
    }
}
