<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Showcase extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'talent_id',
        'meeting_link',
        'test_link',
        'date',
        'time',
        'timezone',
        'status'
    ];


    /**
     * Get the talent that owns the Showcase
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function talent(): BelongsTo
    {
        return $this->belongsTo(Talent::class, 'talent_id');
    }
}
