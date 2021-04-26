<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $limit = 5;

        $roles = [
            [
                'name' => 'Admin',
            ],
            [
                'name' => 'User',
            ],
        ];

        foreach ($roles as $key => $value) {
            Role::create($value);
        }

        $users = [
            [
                'name' => 'Admin Nauval',
                'username' => 'admin_nauval',
                'email' => 'admin_nauval@mail.com',
                'password' => Hash::make(123456),
                'photo' => 'admin.jpg',
                'roles_id' => 1
            ],
            [
                'name' => 'User Nauval',
                'username' => 'user_nauval',
                'email' => 'user_nauval@mail.com',
                'password' => Hash::make(123456),
                'photo' => 'user.jpg',
                'roles_id' => 2
            ],
        ];

        foreach ($users as $key => $value) {
            User::create($value);
        }
    }
}
