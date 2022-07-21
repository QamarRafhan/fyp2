<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Payment extends Model
{
    use HasFactory;

    /** @var array */
    protected $fillable = [
        'customer_id',
        'date',
        'amount',
        'tax_deducted',
        'reference',
        'bank_id',
        'note',
        'user_id',
        'payment_mothod'

    ];

    protected $casts = [
        'date' => 'datetime'
    ];
    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return ($this->d_name == 'u_name') ?  $this->salutation . " " . $this->f_name . " " . $this->l_name : $this->company;
    }


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
     * The customer that belong to the invoice.
     */
    public function bank(): BelongsTo
    {
        return $this->belongsTo(Banking::class);
    }
}
