<?php

namespace App\Http\Requests;

use App\Rules\ProductQty;
use Illuminate\Foundation\Http\FormRequest;

class StockProductRequest extends FormRequest
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
            'sku' => 'nullable|min:3|max:10',
            'product_id' => 'required|exists:products,id',
            'manage_stock' => 'required|in:0,1',
            'in_stock' => 'required|in:0,1',
//            'qty' => 'required_if:manage_stock,==,1',
            'qty' => [new ProductQty($this ->manage_stock )],
        ];
    }
}
