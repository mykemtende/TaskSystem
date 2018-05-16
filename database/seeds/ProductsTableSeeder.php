<?php

use Illuminate\Database\Seeder;
use App\Product;
class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            for ($i = 0; $i < 1; $i++) {
        	Product::create([
        		'name' => 'iPad',
        		'desc' => 'brand new ipad ',
        		'price' => '75000',
        		'quantity' => '500'
        		]);
    }
}
}
