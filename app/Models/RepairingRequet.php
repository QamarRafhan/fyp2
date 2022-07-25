<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepairingRequet extends Model
{
    use HasFactory;
     /** @var array */
     protected $fillable = [
        'title',
        'description',
        'video_url',
    ];
}
