<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@bplo.com',
            'is_admin' => 1,
            'email_verified_at' => now(),
            'password' => Hash::make('1234567890'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
