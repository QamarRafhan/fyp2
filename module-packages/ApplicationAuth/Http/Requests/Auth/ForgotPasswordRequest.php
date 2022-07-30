<?php

namespace Modules\ApplicationAuth\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Modules\ApplicationAuth\Entities\ApplicationUser;

class ForgotPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !($user = $this->user()) ||
               !($user instanceof ApplicationUser);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => [
                'required',
                'string',
            ],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'username' => ucfirst(trans('application-auth::user.username')),
        ];
    }
}
