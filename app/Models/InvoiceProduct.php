<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvoiceProduct extends Model
{
    use HasFactory;
    protected $table = 'invoice_product';
    /** @var array */
    protected $fillable = [
        'price',
        'quantity',
        'discount',
        'tax',
        'invoice_id',
        'product_id',

    ];


    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
