<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hire extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['category_id','user_id','skills','level','availability','workplace','duration','available_in'];
    /**
     * Set the hire's available_in attr.
     *
     * @param  string  $value
     * @return void
     */
    public function setAvailableInAttribute($value)
    {
        $this->attributes['available_in'] = $value !== 'Immediately' ? $value.' Weeks': $value;
    }

    /**
     * Set the hire's duration attr.
     *
     * @param  string  $value
     * @return void
     */
    public function setDurationAttribute($value)
    {
        $this->attributes['duration'] = $value.' Months';
    }
}
