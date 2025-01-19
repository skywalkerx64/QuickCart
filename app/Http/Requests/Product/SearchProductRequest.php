<?php

namespace App\Http\Requests\Product;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class SearchProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => "nullable|string|max:255",
            "description" => "nullable|string|max:255",
            "price" => "nullable|array",
            "price.min" => "nullable|numeric",
            "price.max" => "nullable|numeric",
            "category" => "nullable|string|max:255",
            "status" => "nullable|string|max:255|in:".implode(',', Product::STATUSES),
            "per_page" => "nullable|numeric",
        ];
    }
}
