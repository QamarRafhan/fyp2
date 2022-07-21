<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    /** @var array */
    protected $fillable = [
        'title',
        'description',
        'unit',
        'sku',

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

    /**
     * Get the stock for the product.
     */
    public function stock()
    {
        return $this->hasMany(Stock::class);
    }
}
