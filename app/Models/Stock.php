<?php

namespace App\Models;


use App\Models\Vendor;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Stock extends Model
{
    use HasFactory;

    /** @var array */
    protected $fillable = [
        'stock_name',
        'price',
        'quantity',
        'vendor_id',
        'product_id',

    ];
    /**
     * Get the record of Variation of the product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|App\Models\ProductVariation
     */
   

    /**
     * The vendor that belong to the invoice.
     */
    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }
    /**
     * The product that belong to the invoice.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
