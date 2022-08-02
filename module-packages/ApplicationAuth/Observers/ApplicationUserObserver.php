<?php

namespace Modules\ApplicationAuth\Observers;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use Jdenticon\Identicon;
use Modules\ApplicationAuth\Entities\ApplicationUser;

class ApplicationUserObserver
{
    /** @var \Illuminate\Contracts\Hashing\Hasher */
    private Hasher $hasher;

    /**
     * @param \Illuminate\Contracts\Hashing\Hasher $hasher
     */
    public function __construct(Hasher $hasher)
    {
        $this->hasher = $hasher;
    }

    /**
     * @param \Modules\ApplicationAuth\Entities\ApplicationUser $user
     * @return void
     * @throws \Exception
     */
    public function creating(ApplicationUser $user): void
    {
        /** @var \Modules\ApplicationAuth\Entities\ApplicationUser $model */
        $model = Config::get('application-auth.models.user', ApplicationUser::class);

        // if (!$user->username) {
        //     // Generate a random unique account identifier.
        //     do {
        //         $user->username = Str::random(16);

        //         ($query = $model::query())
        //             ->where($query->qualifyColumn('username'), $user->username);
        //     } while ($query->exists());
        // }

        // Generate a random (long) password in case user doesn't have a password yet.
        $user->password = $user->password ?? $this->hasher->make(Str::random(50));

        // Set the user's name to the user_account if no name has been specified.
        $user->name = $user->name ?? $user->username;

        if (!$user->avatar) {
            if ($placeholder = Config::get('application-auth.avatar_placeholder')) {
                $user->avatar = new \SplFileInfo($placeholder);
            } else {
                $options = [
                    'value' => $user->email ?? $user->username,
                    'size' => 400,
                ];

                $user->avatar = (new Identicon($options))
                    ->getImageDataUri('png');
            }
        }
    }

    /**
     * @param \Modules\ApplicationAuth\Entities\ApplicationUser $user
     * @return void
     */
    public function updated(ApplicationUser $user): void
    {
        if ($user->isDirty('email') &&
            !$user->isDirty('email_verified_at') &&
            !$user->isDirty('verify_email_token')) {
            $user->email_verified_at = null;

            if ($user instanceof MustVerifyEmail) {
                $user->sendEmailVerificationNotification();
            }
        }
    }
}
