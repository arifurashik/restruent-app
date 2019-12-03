<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //for create admin user
        $this->call(UsersTableSeeder::class);
        //for create type and category
        $this->call(TypeCategorySeeder::class);
    }
}
