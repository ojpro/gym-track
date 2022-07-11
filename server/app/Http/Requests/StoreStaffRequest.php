<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStaffRequest extends FormRequest
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
            'first_name' =>['required','string','min:3'],
            'last_name'=>['required','string','min:3'],
            'phone'=>['string','min:10','max:15'],
            'username'=>['string','unique:staff'],
            'email'=>['required','email','unique:staff'],
            'password'=>['required','string','min:8'],
            'gym_id'=>['required','exists:gyms,id']
        ];
    }
}
