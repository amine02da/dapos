<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            "first_name" => "super",
            "last_name" => "admin",
            "email" => "admin@pos.com",
            "password" => Hash::make("aminedaaboub"),
        ]);

        $user->attachRole("super_admin");
    }
}
