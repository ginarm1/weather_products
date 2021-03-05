<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $name = 'products';

    protected $fillable = [
        'id',
        'sku',
        'name',
        'cost'
    ];

    public function weathers() {
        return $this->belongsToMany(Weather::class)->withTimestamps();
    }
}
