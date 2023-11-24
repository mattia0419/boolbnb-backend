<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateApartmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "title" => ["required", "string"],
            "rooms" => ["nullable", "integer"],
            "beds" => ["nullable", "integer"],
            "bathrooms" => ["nullable", "integer"],
            "square_meters" => ["nullable", "integer"],
            "address" => ["nullable", "string"],
            "longitude" => ["nullable"],
            "latitude" => ["nullable"],
            "price" => ["nullable"],
            "visible" => ["required", "boolean"],
            "cover_img" => ["nullable", "image"],
            "services" => ["required", "min:1", "exists:services,id"],
        ];
    }
    public function messages()
    {
        return [
            "services.required" => "Choose at least one.",
        ];
    }
}