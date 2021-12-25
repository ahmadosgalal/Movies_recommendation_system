<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'username' => 'admin',
            'first_name' => 'Ahmed',
            'last_name' => 'Osama',
            'email' => 'ahmad@gmail.com',
            'password' => Hash::make("ahmad123"),
            'role' => 'Admin'
        ]);
    }
}
