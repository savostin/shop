<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CartAddRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'product' => ['int', 'min:1', 'required'],
            'qty' => ['int', 'min:1', 'required'],
            'variation' => ['uuid', 'required'],
        ];
    }
}
