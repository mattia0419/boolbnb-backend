<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApartmentRequest extends FormRequest
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
            "rooms" => ["required", "integer"],
            "beds" => ["required", "integer"],
            "bathrooms" => ["required", "integer"],
            "square_meters" => ["required", "integer"],
            "address" => ["required", "string"],
            "price" => ["required"],
            "visible" => ["required", "boolean"],
            "cover_img" => ["required", "image"],
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