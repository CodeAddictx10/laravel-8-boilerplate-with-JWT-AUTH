<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SavedProfile extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
       'talent_id',
       'user_id',
    ];

    /**
     * Get the user that owns the SavedProfile
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the user that owns the SavedProfile
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function talent(): BelongsTo
    {
        return $this->belongsTo(Talent::class, 'talent_id');
    }
}
