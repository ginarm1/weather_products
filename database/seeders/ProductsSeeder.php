<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Weather;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Product::factory(5) ->create();

        foreach (Product::all() as $product) {
            $weathers = Weather::inRandomOrder() -> take(rand(1,1)) -> pluck('id');
            $product->weathers()->attach($weathers);
        }
    }
}
