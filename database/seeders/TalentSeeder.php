<?php

namespace Database\Seeders;

use App\Models\Talent;
use Illuminate\Database\Seeder;

class TalentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Talent::factory()
            ->count(50)
            ->create();
    }
}
