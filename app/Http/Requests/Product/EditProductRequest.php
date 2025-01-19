<?php

namespace App\Http\Requests\Product;

use App\Models\Product;
use App\Traits\Requests\Requestable;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;

class EditProductRequest extends FormRequest
{
    use Requestable;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('product_edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => "sometimes|string|max:255",
            "description" => "sometimes|string|max:255",
            "price" => "sometimes|numeric",
            "category" => "sometimes|exists:product_categories,name|string|max:255",
            "status" => "sometimes|string|max:255|in:".implode(',', Product::STATUSES),

            "cover" => "sometimes|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",

            "images" => "sometimes|nullable|array",
            "images.*" => "sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:204800",
        ];
    }
}
