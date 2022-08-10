<?php

namespace App\Models;

use App\Models\User;
use App\Models\Vehicle;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RepairingRequet extends Model
{
    use HasFactory;
    /** @var array */
    protected $fillable = [
        'title',
        'description',
        'video_url',
        'customer_id',
        'mechanic_id',
        'category_id',
        'vehicle_id'
    ];





    /**
   
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this
            ->belongsTo(
                Category::class
            );
    }

    /**
   
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vehicle(): BelongsTo
    {
        return $this
            ->belongsTo(
                Vehicle::class
            );
    }

    /**
   
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this
            ->belongsTo(
                User::class,
                'customer_id'
            );
    }

    /**
   
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mechanic(): BelongsTo
    {
        return $this
            ->belongsTo(
                User::class,
        
                'mechanic_id'
            );
    }
}
