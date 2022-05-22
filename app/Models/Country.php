<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Location;

class Country extends Model
{
    use HasFactory;

    /**
    * Indicates if the model should be timestamped.
    *
    * @var bool
    */
    public $timestamps = false;

    /**
     * Get all of the cities for the Country
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cities(): HasMany
    {
        return $this->hasMany(Location::class, 'country_id');
    }
}
