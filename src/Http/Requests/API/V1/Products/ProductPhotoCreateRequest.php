<?php

namespace Sajadsdi\Marketplace\Http\Requests\API\V1\Products;

use Sajadsdi\LaravelRestResponse\Http\Requests\BaseRequest;

class ProductPhotoCreateRequest extends BaseRequest
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
            'photo' => 'required|image|max:10240',
        ];
    }

}
