<?php

namespace Database\Factories;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

class TalentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'middle_name' => $this->faker->lastName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'title' => $this->faker->title(),
            'location_id' => Location::inRandomOrder()->first()->id,
            'summary'=>$this->faker->paragraph(7),
            'experience'=>$this->exp(),
            'level'=>  (Location::inRandomOrder()->first()->id % 2) ? 'Mid-Level':'Entry-Level',
            'availability'=>(Location::inRandomOrder()->first()->id % 2) ? 'Full-Time':'Part-Time',

        ];
    }
    public function exp()
    {
        $values = array();
        for ($i = 0; $i < 5; $i++) {
            $values []= ["company"=>$this->faker->company(), "title"=>$this->faker->sentence(), ];
        }
        return $values;
    }
}