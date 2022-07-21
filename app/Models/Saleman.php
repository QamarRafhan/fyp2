<?php

namespace App\Models;

use App\Models\Header;
use App\Models\Lining;
use App\Models\ProductVariation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Saleman extends Model
{
    use HasFactory;
    protected $table = 'salemans';

    /** @var array */
    protected $fillable = [
        'type',
        'salutation',
        'f_name',
        'l_name',
        'd_name',
        'email',
        'designation',
        'phone',
        'mobile',
        'website',
        'user_id',
    ];
    /**
     * Get the record of Variation of the product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|App\Models\ProductVariation
     */
    public function variations(): HasMany
    {
        return $this
            ->hasMany(
                ProductVariation::class,
                'p_id',
                'id',
                'variations'
            );
    }

    /**
     * The headrs that belong to the product.
     */
    public function headers(): BelongsToMany
    {
        return $this->belongsToMany(Header::class);
    }
    /**
     * The linings that belong to the product.
     */
    public function linings(): BelongsToMany
    {
        return $this->belongsToMany(Lining::class);
    }
}
