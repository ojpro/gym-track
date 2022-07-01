<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOwnerRequest extends FormRequest
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
        //TODO: needs improvement
        return [
            'full_name' => ['string', 'min:3'],
            'phone' => ['string', 'min:10', 'max:15'],
            'email' => ['unique:owners,email', 'email']
        ];
    }
}
