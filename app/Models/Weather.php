<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    use HasFactory;

    protected $name = 'weather';

    protected $fillable = [
        'id',
        'name'
    ];

    public function products() {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }
}
