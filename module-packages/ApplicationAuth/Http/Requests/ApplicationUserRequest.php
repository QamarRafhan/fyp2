<?php

namespace Modules\ApplicationAuth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Config;
use Illuminate\Validation\Rule;
use Modules\ApplicationAuth\Entities\ApplicationUser;
use Modules\ApplicationAuth\Http\Requests\Rules\ValidateAvatar;

class ApplicationUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return ($user = $this->user()) &&
            ($user instanceof ApplicationUser) &&
            $user->guest;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $locales = array_unique(Config::get('application-auth.locales', []));
        if (empty($locales)) {
            $locales = array_unique(
                [
                    Config::get('app.locale'),
                    Config::get('app.fallback_locale'),
                ]
            );

            if (empty($locales)) {
                $locales = ['en'];
            }
        }

        return [
            'username' => [
                'sometimes',
                'string',
                'between:3,255',
                Rule::unique('application_users', 'username'),
            ],
            'avatar' => [
                'sometimes',
                'nullable',
                new ValidateAvatar(),
            ],
            'name' => [
                'sometimes',
                'string',
                'between:3,255',
            ],
            'email' => [
                'sometimes',
                'string',
                'email:strict,spoof,dns',
            ],
            'locale' => [
                'sometimes',
                'nullable',
                'in:' . implode(',', $locales),
            ],
            'allow_notifications' => [
                'sometimes',
                'boolean'
            ]
        ];
    }

    public function messages()
    {
        return [
            'username.unique' => trans('application-auth::user.username_exists'),
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
            'avatar' => ucfirst(trans('application-auth::user.avatar')),
            'name' => ucfirst(trans('application-auth::user.name')),
            'email' => ucfirst(trans('application-auth::user.email')),
            'locale' => ucfirst(trans('application-auth::user.locale')),
            'allow_notifications' => ucfirst(trans('application-auth::user.allow_notifications')),
        ];
    }
}
