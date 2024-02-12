<?php

namespace Sajadsdi\Marketplace\Http\Requests\API\V1\Orders;

use Sajadsdi\LaravelRestResponse\Http\Requests\BaseRequest;

class OrderCreateRequest extends BaseRequest
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
     */
    public function rules(): array
    {
        return [
            'shipping'            => ['required', 'boolean'],
            'products'            => ['required', 'array'],
            'products.*.id'       => ['required', 'exists:products,id'],
            'products.*.quantity' => ['required', 'numeric', 'min:1', 'max:100'],
        ];
    }

}
