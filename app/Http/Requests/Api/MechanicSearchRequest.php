<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class MechanicSearchRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'latitude' => [
                'required',
                'between:3,255',
            ],
            'longitude' => [
                'required',
                'between:3,255',

            ]

        ];
    }
}
