<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Talent extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'talents';

    /**
     * Get the talent's avatar.
     *
     * @param  string  $value
     *
     * @return string
     */
    public function getAvatarAttribute($value)
    {
        if ($value) {
            if (Str::contains($value, 'https://ui-avatars')) {
                return $value;
            }
            return str_replace("digitaloceanspaces.com", "cdn.digitaloceanspaces.com/talents", Storage::disk('digitalocean')->url($value));
        } else {
            return null;
        }
    }

    /**
    * The attributes that should be cast.
    * @var array<string, string>
    */
    protected $casts = [
        'experience'=> 'array',
        'education'=> 'array'
    ];

    /**
     * Get all of the skills for the Talent
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function skills(): HasMany
    {
        return $this->hasMany(TalentSkill::class, 'talent_id');
    }

    /**
     * Get the category that owns the Talent
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    /**
     * Get all of the showcases for the Talent
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function showcases(): HasMany
    {
        return $this->hasMany(Showcase::class, 'talent_id');
    }
}
