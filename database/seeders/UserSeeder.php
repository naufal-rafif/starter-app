<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin Test',
                'email' => 'naufal@admin.com',
                'password' => bcrypt('password123')
            ],
        ];
        foreach($users as $user){
            User::updateOrCreate([
                'email' => $user['email']
            ],[
                'password' => $user['password'],
                'name' => $user['name']
            ]);
        }
    }
}
