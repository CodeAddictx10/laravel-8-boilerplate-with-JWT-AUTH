<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
    * Indicates if the model should be timestamped.
    *
    * @var bool
    */
    public $timestamps = false;

    /**
    *Category has many skills relation
    */
    public function skills()
    {
        return $this->hasMany(Skill::class);
    }
}
