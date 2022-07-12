<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubscriptionRequest extends FormRequest
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
            'status' => ['in:current,pending,canceled,expired'],
            'member_id' => ['exists:members,id'],
            'membership_id' => ['exists:memberships,id'],
            'number' => ['numeric'],
            'started_at' => ['date'],
            'expire_at' => ['date']
        ];
    }
}
