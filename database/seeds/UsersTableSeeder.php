<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'role' => '1',
            'name' => 'Mr.Admin',
            'email' => 'admin@restaurant.com',
            'password' => bcrypt('12345678')
        ]);
    }
}
