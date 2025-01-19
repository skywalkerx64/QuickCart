<?php

namespace App\Http\Requests\Product;

use App\Models\Product;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('product_create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required|string|max:255",
            "description" => "nullable|string|max:255",
            "price" => "required|numeric",
            "category" => "required|exists:product_categories,name|string|max:255",
            "status" => "nullable|string|max:255|in:".implode(',', Product::STATUSES),

            "cover" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",

            "images" => "nullable|array",
            "images.*" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
        ];
    }
}
