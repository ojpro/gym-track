<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOwnerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //TODO: protect it
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'full_name' => ['required', 'string', 'min:3'],
            'phone' => ['required_without:email', 'string', 'min:10', 'max:15'],
            'email' => ['required_without:phone', 'unique:owners', 'email'],
            'password' => ['required', 'confirmed', 'min:8']
        ];
    }
}
