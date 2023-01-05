<?php

namespace Database\Seeders;

use App\Models\User;
use App\Shared\UserConstant;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()->truncate();
        User::create([
            'email' => 'user@mail.com',
            'password' => bcrypt('12345678'),
            'name' => 'Phong KT',
            'role_id' => UserConstant::USER_ROLE_USER
        ]);
        User::create([
            'email' => 'admin@mail.com',
            'password' => bcrypt('12345678'),
            'name' => 'admin',
            'role_id' => UserConstant::USER_ROLE_ADMIN
        ]);
        User::create([
            'email' => 'user2@mail.com',
            'password' => bcrypt('12345678'),
            'name' => 'Test User 2',
            'role_id' => UserConstant::USER_ROLE_USER
        ]);
    }
}
