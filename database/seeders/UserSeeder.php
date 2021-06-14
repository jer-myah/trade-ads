<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        DB::table('users')->insert([
            'id' => 'hteSF5h87Bmkwi-dj',
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@trade-ads.com',
            'role' => 'administrator',
            'status' => 'active',
            'password' => Hash::make('admin-trade-ads'),
        ]);
    }
}

