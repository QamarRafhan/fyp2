<?php

namespace App\Models;

use Traits\MediaManagerTrait;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Modules\ApplicationAuth\Entities\ApplicationUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends ApplicationUser
{
    use HasApiTokens, HasFactory, Notifiable;
    use MediaManagerTrait;
    use InteractsWithMedia;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
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
        'role',
        'images'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    /** @var const */
    const COLLECTION_NAME = 'user';


    /**
     * @return string|null
     */
    public function getImagesAttribute()
    {


        return $this->getMedia(self::COLLECTION_NAME);
    }


    /**
     * @return \Spatie\MediaLibrary\MediaCollections\Models\Media|null
     *
     * @return \Illuminate\Support\Collection
     */
    public function getImagesMediaAttribute()
    {
        return $this->getMedia(self::COLLECTION_NAME);
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    /**
     * @param \SplFileInfo|\Spatie\MediaLibrary\MediaCollections\Models\Media|string|null $value
     * @return $this
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileCannotBeAdded
     * @throws \Exception
     */
    public function setImagesAttribute($value)
    {
        return $this->processMedia($value, self::COLLECTION_NAME, $this->images);
    }
    public function setDeleteMediaAttribute($value)
    {
        return $this->modelMediaToDelete($value, $this->images);
    }

    /**
     * registerMediaCollections function
     *
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $collections = [
            [
                'collection' => self::COLLECTION_NAME,
                'limit' => 2
            ]
        ];
        $this->handleRegisterMediaCollections($collections);
    }

    /**
     * @param \Spatie\MediaLibrary\MediaCollections\Models\Media|null $media
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->handleRegisterMediaConversions($media);
    }
    
}
