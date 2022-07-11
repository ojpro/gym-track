<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMemberRequest extends FormRequest
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
        return [
            'card_id' => ['string', 'min:5'],
            'first_name' => ['required', 'string', 'min:3'],
            'last_name' => ['required', 'string', 'min:3'],
            'birthday' => ['date'],
            'gender' => ['enum:male,female,indeterminate,unknown'],
            'weight' => ['numeric'],
            'height' => ['numeric'],
            'address' => ['string', 'min:3'],
            'photo' => ['string'],
            'phone' => ['string', 'min:10', 'max:20'],
            'username' => ['unique:members','string'],
            'email' => ['unique:members','email'],
            'password' => ['string', 'min:8']
        ];
    }
}
