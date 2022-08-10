<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'rr_id' => [
                'required',

            ],
            'amount' => [
                'required',

            ],
            'card_nubmer' => [

                'required',
            ]

        ];
    }
}
