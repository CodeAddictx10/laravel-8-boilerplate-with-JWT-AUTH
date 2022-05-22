<?php

namespace Database\Seeders;

use App\Models\TalentSkill;
use Illuminate\Database\Seeder;

class TalentSkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TalentSkill::factory()
            ->count(70)
            ->create();
    }
}
