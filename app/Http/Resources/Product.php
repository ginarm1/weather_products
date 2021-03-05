<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
//        return [
//            'sku' => $this->sku,
//            'name' => $this->name,
//            'cost' => $this->cost,
//        ];
    }

    public function with($request)
    {
        return [
            'source_url' => url('https://api.meteo.lt/'),
            'source_name' => 'LHMT'
        ];
    }

}
