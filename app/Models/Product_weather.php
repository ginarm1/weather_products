<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_weather extends Model
{
    use HasFactory;

    protected $table = 'product_weather';

    protected $fillable = [
        'id',
        'product_sku',
        'weather_id',
    ];
}
