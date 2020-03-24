<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Administrator',
                'email' => 'admin@admin.com',
                'password' => Hash::make('passwordadmin'),
                'is_admin' => 1
            ],
            [
                'name' => 'Officer',
                'email' => 'officer@officer.com',
                'password' => Hash::make('passwordofficer'),
                'is_admin' => 0
            ]
        ];

        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
