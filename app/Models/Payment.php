<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;


    /** @var array */
    protected $fillable = [
        'rr_id',
        'date',
        'amount',
        'tax_deducted',
        'mechanic_id',
        'reference',
        'payment_mothod'
    ];

    public function repairingRequet(): BelongsTo
    {
        return $this->belongsTo(RepairingRequet::class, 'rr_id');
    }
}
