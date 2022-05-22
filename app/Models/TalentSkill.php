<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TalentSkill extends Model
{
    use HasFactory;

    /**
     * Get the skill that owns the TalentSkill
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function skill(): BelongsTo
    {
        return $this->belongsTo(Skill::class, 'skill_id');
    }

    /**
     * Get the talent that owns the TalentSkill
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function talent(): BelongsTo
    {
        return $this->belongsTo(Talent::class, 'talent_id');
    }
}
