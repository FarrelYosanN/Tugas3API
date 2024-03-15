<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePersonRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'age' => 'nullable|integer',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
        ];
    }
}
