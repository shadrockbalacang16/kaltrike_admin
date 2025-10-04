<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DBSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = [
            ['name' => 'User', 'email' => 'user@bplo.com', 'password' => Hash::make('1234567890'), 'is_admin' => 0],
            ['name' => 'Admin', 'email' => 'admin@bplo.com', 'password' => Hash::make('1234567890'), 'is_admin' => 1],
        ];

        foreach($users as $user) {
            DB::table('users')->insert([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => $user['password'],
                'is_admin' => $user['is_admin']
            ]);
        }
    }
}
