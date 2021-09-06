<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

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
            'id' => 'htehfe3SF5-h87Bmkwi-d97hy3fj',
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@trade-ads.com',
            'country' => 'Nigeria',
            'role' => 'administrator',
            'status' => 'active',
            'ip_address' => '127.0.0.1',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('admin-trade-ads'),
        ]);
    }
}

