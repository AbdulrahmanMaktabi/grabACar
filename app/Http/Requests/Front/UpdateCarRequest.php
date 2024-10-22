<?php

namespace App\Http\Requests\Front;

use Illuminate\Support\Facades\Auth;


use Illuminate\Foundation\Http\FormRequest;

class UpdateCarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (isSameUser('web', Auth::guard('web')->user()->id))
            return true;
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => ["nullable", "string"],
            "owner_id" => ["nullable", "exists:users,id"],
            "marker_id" => ["nullable", "exists:markers,id"],
            "model_id" => ["nullable", "exists:models,id"],
            "carType_id" => ["nullable", "exists:car_types,id"],
            "fuel_id" => ["nullable", "exists:fuels,id"],
            "year" => ["nullable"],
            // 'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'image' => ['nullable'],
            'price' => ['nullable'],
            'vin' => ['nullable'],
            'mileage' => ['nullable'],
            'address' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'car_specifications' => ['nullable', 'string'],
        ];
    }
}
