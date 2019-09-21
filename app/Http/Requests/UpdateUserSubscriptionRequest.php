<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserSubscriptionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'endpoint' => 'required|string',
            'key' => 'required|string',
            'token' => 'required|string',
            'contentEncoding' => 'required|string'
        ];
    }
}
