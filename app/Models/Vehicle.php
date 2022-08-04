<?php

namespace App\Models;

use Traits\MediaManagerTrait;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Vehicle extends Model implements HasMedia
{
    use MediaManagerTrait;
    use InteractsWithMedia;

    use HasFactory;
    /** @var array */
    protected $fillable = [
       'title',
       'description',
       'model',
       'category_id',
       'company_id',
       'images'
   ];
   /** @var const */
   const COLLECTION_NAME = 'vehicles';


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
               'limit' => 1
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

   public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
