<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Banking extends Model
{
    use HasFactory;

    /** @var array */
    protected $fillable = [
        'type',
        'acc_name',
        'acc_holder_name',
        'acc_code',
        'currency',
        'acc_num',
        'bank_name',
        'routing_num',
        'description',
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
