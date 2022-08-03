<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vehicle extends Model
{
    use HasFactory;
    /** @var array */
    protected $fillable = [
       'title',
       'description',
       'model',
       'category_id',
       'company_id'
   ];

   public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
