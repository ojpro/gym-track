<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGymRequest extends FormRequest
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
            'name' => ['string', 'min:3', 'max:250'],
            'slogan' => ['string', 'min:3', 'max:250'],
            'description' => ['string', 'min:3'],
            'logo' => ['string', 'min:3'],
            'owner_id' => ['exists:owners,id']
        ];
    }
}
