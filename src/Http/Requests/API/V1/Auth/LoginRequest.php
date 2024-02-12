<?php

namespace Sajadsdi\Marketplace\Http\Requests\API\V1\Auth;

use Sajadsdi\LaravelRestResponse\Http\Requests\BaseRequest;

class LoginRequest extends BaseRequest
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
            'email'    => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

}
