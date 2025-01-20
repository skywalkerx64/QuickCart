<?php

namespace App\Http\Requests\Order;

use App\Traits\Requests\Requestable;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    use Requestable;
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
            'products' => 'array|required',
            'products.*' => 'array',
            'products.*.id' => 'numeric||exists:products,id',
            'products.*.quantity' => 'numeric|integer',
            'customer' => 'array|required',
            'customer.email' => 'string|email|required',
            'customer.contact' => 'string|nullable',
            'customer.address' => 'string|nullable',
        ];
    }
}
