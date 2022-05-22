<?php

namespace Database\Factories;

use App\Models\Skill;
use App\Models\Talent;
use Illuminate\Database\Eloquent\Factories\Factory;

class TalentSkillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'skill_id' => Skill::inRandomOrder()->first()->id,
            'talent_id' => Talent::inRandomOrder()->first()->id,
        ];
    }
}
