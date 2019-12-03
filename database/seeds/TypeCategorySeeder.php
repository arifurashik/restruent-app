<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //for product type
        DB::table('product_types')->insert([
            'type_name' => 'Storable',
        ]);
        DB::table('product_types')->insert([
            'type_name' => 'Non Storable',
        ]);
        //for category
        DB::table('categories')->insert([
            'cat_name' => 'Fast food',
        ]);
        DB::table('categories')->insert([
            'cat_name' => 'Soft Drinks',
        ]);
        DB::table('categories')->insert([
            'cat_name' => 'Chines',
        ]);
        DB::table('categories')->insert([
            'cat_name' => 'Mexican',
        ]);
    }
}
