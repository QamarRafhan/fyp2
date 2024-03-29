<?php

use App\Models\User;
use Modules\ApplicationAuth\Entities\ApplicationUser;
use Modules\ApplicationAuth\Entities\ApplicationUserLogin;
use Modules\ApplicationAuth\Entities\ApplicationUserToken;
use Modules\ApplicationAuth\Http\Controllers\ApplicationUserController;
use Modules\ApplicationAuth\Http\Controllers\AuthController;
use Modules\ApplicationAuth\Transformers\ApplicationUserResource;

return [
    'auth' => [
        /*
         * The name of the auth guard.
         */
        'guard' => 'application',

        /*
         * The name for the user provider.
         */
        'provider' => 'users',

        /*
         * The token refresh ttl for guest users, set this to a long time (default is 10 years) so the token can be
         * refreshed again even if the user has not used the application for a long time.
         */
        'guest_refresh_ttl' => env('JWT_GUEST_REFRESH_TTL', 5256000),

        /*
         * The maximum number of times a user can login before being blocked. Set to 0 to disable.
         */
        'limit_logins' => 0,
    ],

    /*
     * The controllers to use.
     */
    'controllers' => [
        'auth' => AuthController::class,
        'user' => ApplicationUserController::class,
    ],

    /*
     * The model to use, it must extend \Modules\ApplicationAuth\Entities\ApplicationUser or it will throw errors
     * in various parts of the module.
     */
    'models' => [
        'user' => User::class,
        'login' => ApplicationUserLogin::class,
        'token' => ApplicationUserToken::class,
    ],

    /*
     * The resource to use for responses, it must extend \Modules\ApplicationAuth\Transformers\ApplicationUser or it
     * will throw errors in various parts of the module.
     */
    'resource' => ApplicationUserResource::class,

    /*
     * The locales that can be set on the user.
     */
    'locales' => [
        'en',
        'nl'
    ],

    /*
     * The placeholder to use for the avatar.
     */
    'avatar_placeholder' => null,
];
