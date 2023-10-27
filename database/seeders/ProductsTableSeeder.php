<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
           DB::table('products')->insert([
            'sku' => 'PROD001',
            'name' => 'Product 1',
            'price' => 10000,
            'reference' => 'REF001',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
