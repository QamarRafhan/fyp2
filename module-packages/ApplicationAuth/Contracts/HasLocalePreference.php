<?php

namespace Modules\ApplicationAuth\Contracts;

use Illuminate\Contracts\Translation\HasLocalePreference as BaseContract;

interface HasLocalePreference extends BaseContract
{
    /**
     * Updates the preferred locale for the entity.
     *
     * @param string $locale
     */
    public function setPreferredLocale(string $locale): void;
}
