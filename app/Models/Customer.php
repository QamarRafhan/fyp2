<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Customer extends Model
{
    use HasFactory;

    /** @var array */
    protected $fillable = [
        'type',
        'salutation',
        'f_name',
        'l_name',
        'd_name',
        'company',
        'email',
        'phone',
        'mobile',
        'website',
        'user_id',
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
     * Get the record of payments of the Customer
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments(): HasMany
    {
        return $this
            ->hasMany(
                Payment::class,
                'customer_id',
                'id',
                'payments'
            );
    }
}
