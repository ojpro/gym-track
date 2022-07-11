<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMembershipRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'attendances' => ['required', 'numeric', 'min:1'],
            'price' => ['required', 'numeric'],
            'notes' => ['string', 'min:3'],
            'gym_id' => ['required', 'exists:gyms,id']
        ];
    }
}
