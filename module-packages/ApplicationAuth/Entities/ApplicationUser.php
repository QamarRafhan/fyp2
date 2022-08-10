<?php

namespace Modules\ApplicationAuth\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Exceptions\InvalidBase64Data;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Mime\MimeTypes;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * Modules\ApplicationAuth\Entities\ApplicationUser
 *
 * @property int $id
 * @property string $locale
 * @property string $username
 * @property string $name
 * @property string|null $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $reset_password_token
 * @property \Illuminate\Support\Carbon|null $reset_password_token_expires
 * @property bool $guest
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Spatie\MediaLibrary\MediaCollections\Models\Media|null $avatar
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\ApplicationAuth\Entities\ApplicationUserLogin[] $logins
 * @property-read int|null $logins_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\ApplicationAuth\Entities\ApplicationUserToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationUser query()
 * @mixin \Eloquent
 */
class ApplicationUser extends Authenticatable implements JWTSubject, HasMedia
{
    use InteractsWithMedia;
    use Notifiable;

    const LOCALE_EN = "en";
    const LOCALE_NL = "nl";

    const AVAILABLE_LOCALES = [
        self::LOCALE_EN,
        self::LOCALE_NL,
    ];

    protected $table = "users";

    protected $casts = [
        'email_verified_at' => 'datetime',
        'reset_password_token_expires' => 'datetime',
        'guest' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    protected $fillable = [
        'username',
        'name',
        'locale',
        'email',
        'email_verified_at',
        'password',
        'reset_password_token',
        'reset_password_token_expires',
        'guest',
        'avatar',
        'allow_notifications',
        'latitude',
        'longitude',
        'status',
        'category_id',
        'role'
    ];

    protected $attributes = [
        'guest' => false,
    ];

    /**
     * @param \SplFileInfo|\Spatie\MediaLibrary\MediaCollections\Models\Media|string|null $value
     * @return $this
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileCannotBeAdded
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Exception
     */
    public function setAvatarAttribute($value): self
    {
        if ($value === null) {
            optional($this->getFirstMedia('avatar'))->delete();

            return $this;
        }

        if ($value instanceof Media) {
            $value->copy($this, 'avatar');

            return $this;
        }

        if (is_string($value)) {
            if (Str::startsWith($value, ['http://', 'https://'])) {
                $this->addMediaFromUrl($value, ['image/jpeg', 'image/png', 'image/webp'])
                    ->toMediaCollection('avatar');

                return $this;
            }

            if (Str::startsWith($value, 'data:')) {
                if (!Str::contains($value, ';base64')) {
                    if (!preg_match('#^data:([^,]+),(.*)$#', $value, $matches)) {
                        throw InvalidBase64Data::create();
                    }

                    $value = 'data:' . $matches[1] . ';base64,' . base64_encode($matches[2]);
                }

                if (!preg_match('#^data:([^;]+);base64,[-A-Za-z0-9+/]+={0,2}$#', $value, $matches)) {
                    throw InvalidBase64Data::create();
                }

                $mime = $matches[1];
                $extension = Arr::first(
                    MimeTypes::getDefault()
                        ->getExtensions($mime)
                ) ?: 'bin';

                $this->addMediaFromBase64($value, ['image/jpeg', 'image/png', 'image/webp'])
                    ->usingFileName(sha1($value) . '.' . $extension)
                    ->toMediaCollection('avatar');

                return $this;
            }

            throw new \InvalidArgumentException("Expected a url, data uri or file");
        }

        if ($value instanceof \SplFileInfo && !($value instanceof File || $value instanceof UploadedFile)) {
            $value = new File($value->getRealPath());
        }

        if ($value instanceof File || $value instanceof UploadedFile) {
            $adder = $this->addMedia($value);

            if (!($value instanceof UploadedFile)) {
                $adder->preservingOriginal();
            }

            $adder->toMediaCollection('avatar');

            return $this;
        }

        throw new \InvalidArgumentException("Expected another media record, a url, a data uri or a file");
    }

    /**
     * @return \Spatie\MediaLibrary\MediaCollections\Models\Media|null
     */
    public function getAvatarAttribute(): ?Media
    {
        return $this->getFirstMedia('avatar');
    }

    /**
     * @inheritDoc
     */
    public function hasVerifiedEmail()
    {
        return !$this->email || !!$this->email_verified_at;
    }

    /**
     * @inheritDoc
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * @inheritDoc
     */
    public function getJWTCustomClaims()
    {
        $scopes = ['guest'];

        if ($this->guest === false) {
            $scopes[] = 'user';
        }

        return [
            Config::get('app.url', 'http://localhost') . '/guest' => $this->guest,
            'scope' => implode(' ', $scopes),
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp'])
            ->singleFile();
        // ->withResponsiveImages();
    }

    /**
     * @param \Spatie\MediaLibrary\MediaCollections\Models\Media|null $media
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_CROP, 150, 150)
            ->keepOriginalImageFormat()
            ->quality(80)
            ->orientation(Manipulations::ORIENTATION_AUTO)
            ->optimize();
        // ->withResponsiveImages();

        $this->addMediaConversion('large')
            ->fit(Manipulations::FIT_CROP, 350, 350)
            ->keepOriginalImageFormat()
            ->quality(80)
            ->orientation(Manipulations::ORIENTATION_AUTO)
            ->optimize();
        // ->withResponsiveImages();

        $this->addMediaConversion('full')
            ->keepOriginalImageFormat()
            ->quality(80)
            ->orientation(Manipulations::ORIENTATION_AUTO)
            ->optimize();
        // ->withResponsiveImages();
    }
}
