<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
