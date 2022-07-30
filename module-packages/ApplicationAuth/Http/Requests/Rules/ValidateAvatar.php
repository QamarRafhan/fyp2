<?php

namespace Modules\ApplicationAuth\Http\Requests\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class ValidateAvatar implements Rule
{
    /**
     * @inheritDoc
     */
    public function passes($attribute, $value)
    {
        $validator = Validator::make(
            ['value' => $value],
            ['value' => ['file', 'mimetypes:image/jpeg,image/png,image/webp']]
        );
        if ($validator->passes()) {
            return true;
        }

        $validator = Validator::make(
            ['value' => $value],
            ['value' => ['string', 'regex:#^data:image/(jpeg|png|webp)(;base64)?,#']]
        );
        if ($validator->passes()) {
            return true;
        }

        $validator = Validator::make(
            ['value' => $value],
            ['value' => ['string', 'regex:#^https?://#', 'active_url']]
        );

        if ($validator->passes()) {
            return true;
        }

        return false;
    }

    /**
     * @return string
     */
    public function message()
    {
        return trans('application-auth::validation.invalid_avatar');
    }
}
