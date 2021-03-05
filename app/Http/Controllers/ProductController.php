<?php

namespace App\Http\Controllers;

use App\Http\Resources\Recommended;
use App\Models\Product;
use App\Http\Resources\Product as ProductResource;
use App\Http\Resources\Recommended as RecommendedResource;
use App\Models\Product_weather;
use App\Models\Weather;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    public function index() {
//        $products = Product::paginate(5);

        $products = cache()->remember('products_all',Carbon::now()->addMinutes(5), function () {
            return Product::all();
        });
        return ProductResource::collection(['products'=>$products]);
    }
    public function show($id){


        $product = cache()->remember('product',Carbon::now()->addMinutes(5), function () use($id) {
            return Product::findOrFail($id);
        });
        return new ProductResource($product);
    }

    public function recommended($city){

//      For the next 3 days depending on the forecast select 2 items
//          that would match the weather forecast.

        $response = Http::get('https://api.meteo.lt/v1/places/'.$city.'/forecasts/long-term');

//        Current day
        $time_period_start = $response->json('forecastTimestamps')[0]['forecastTimeUtc'];

//       Check weather for 3 days
        $time_period = 3;
        $products_count_wanted = 2;
        $days = [];
        $weather_forecasts = [];
        $recommendations = collect();
        $products = [];


//        cache()->remember('recommended_products',Carbon::now()->addMinutes(3),
//                function () use ($time_period,$weather_forecasts,$days,$products,$recommendations) {

            //      Products array index;
            $j = 0;

            for ($i = 0; $i < $time_period; $i++) {

      //        Make 3 days period date and weather forecasts
                $days[$i] = date('Y-m-d', strtotime($time_period_start. ' + '. $i .' days'));

                $weather_forecasts[$i] = $response->json('forecastTimestamps')[$i]['conditionCode'];
                $weather_id = Weather::where('name', $weather_forecasts[$i])->first()->value('id');
                $product_ids = Product_weather::where('weather_id', $weather_id)
                    ->take($products_count_wanted)->get('product_id');

//                Insert first 2 products by id into $products array,
//                  which have the same weather_id (From Product_weather table)

                foreach ($product_ids as $p_id) {
                    $products[$j] = collect(Product::where('id', $p_id->product_id)
                        ->get(['sku', 'name', 'cost']));
                    $j++;
                }

                $recommendations[$i] = [
                    'weather_forecast' => $weather_forecasts[0],
                    'date' => $days[$i],
                    'products' => $products
                ];

                $j = 0;
            }

        cache()->remember('recommended_products',Carbon::now()->addMinutes(5),function () use ($recommendations){
            return $recommendations;
        });

        return RecommendedResource::collection([
            [   'city'=>$city,
                'recommendations'=> $recommendations,
                'source_url' => url('https://api.meteo.lt/'),
                'source_name' => 'LHMT'
            ]
        ]);
    }

}
