<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        return [
            'Name' => $this->name,
            'Makerer' => $this->marker->name,
            'Model' => $this->model->name,
            'Mileage' => $this->mileage,
            'Fuel' => $this->fuel->name,
            'Year' => $this->year,
            'Description' => $this->description,
            'Price' => $this->price,
        ];
    }
}
