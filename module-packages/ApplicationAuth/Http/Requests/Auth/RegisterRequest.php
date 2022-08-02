<?php

namespace Modules\ApplicationAuth\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\ApplicationAuth\Entities\ApplicationUser;
use Modules\ApplicationAuth\Http\Requests\Rules\ValidateAvatar;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !($user = $this->user()) ||
               !($user instanceof ApplicationUser) ||
               $user->guest;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // dd('test');
        return [
            // 'username' => [
            //     'sometimes',
            //     'string',
            //     'between:3,255',
            //     Rule::unique('users', 'username'),
            // ],
            'avatar' => [
                'sometimes',
                'nullable',
                new ValidateAvatar(),
            ],
            'name' => [
                'required',
                'between:3,255',
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')
                // 'email:strict,spoof,dns',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'max:10485760',
                'confirmed',
            ],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'username.unique' => trans('application-auth::register.username_exists'),
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
            // 'username' => ucfirst(trans('application-auth::user.username')),
            'avatar' => ucfirst(trans('application-auth::user.avatar')),
            'name' => ucfirst(trans('application-auth::user.name')),
            'email' => ucfirst(trans('application-auth::user.email')),
            'password' => ucfirst(trans('application-auth::user.password')),
            'password_confirmation' => ucfirst(trans('application-auth::user.password_confirmation')),
        ];
    }

    
}
