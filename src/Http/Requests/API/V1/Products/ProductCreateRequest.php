<?php

namespace Sajadsdi\Marketplace\Http\Requests\API\V1\Products;

use Sajadsdi\LaravelRestResponse\Http\Requests\BaseRequest;

class ProductCreateRequest extends BaseRequest
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
     */
    public function rules(): array
    {
        return [
            'title'          => ['required', 'string', 'min:4', 'max:300'],
            'price'          => ['required', 'numeric', 'min:0', 'max:9999999999.99'],
            'shipping_price' => ['required', 'numeric', 'min:0', 'max:999999.99'],
        ];
    }

}
