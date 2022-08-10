<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class RepairingRequetStore extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => [
                'required'

            ],
            'description' => [
                'required'

            ],
            'video_url' => [
                'sometimes'

            ],
            'customer_id' => [
                'sometimes'

            ],
            'mechanic_id' => [
                'sometimes'

            ],
            'category_id' => [
                'sometimes'

            ],
            'vehicle_id' => [
                'sometimes'

            ],

        ];
    }
}
