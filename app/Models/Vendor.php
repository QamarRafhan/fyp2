<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Vendor extends Model
{
    use HasFactory;

    /** @var array */
    protected $fillable = [
        'salutation',
        'f_name',
        'l_name',
        'company',
        'd_name',
        'email',
        'phone',
        'mobile',
        'website',

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
}
