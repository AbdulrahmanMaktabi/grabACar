<?php

namespace App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreCarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::guard('web')->user()->hasVerifiedEmail();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => ["required", "string"],
            "owner_id" => ["required", "exists:users,id"],
            "marker_id" => ["required", "exists:markers,id"],
            "model_id" => ["required", "exists:models,id"],
            "carType_id" => ["required", "exists:car_types,id"],
            "fuel_id" => ["required", "exists:fuels,id"],
            "year" => ["required"],
            'image' => ['required', 'file', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'price' => ['required'],
            'vin' => ['required'],
            'mileage' => ['required'],
            'address' => ['required', 'string'],
            'description' => ['required', 'string'],
            'car_specifications' => ['required', 'string'],
        ];
    }
}
