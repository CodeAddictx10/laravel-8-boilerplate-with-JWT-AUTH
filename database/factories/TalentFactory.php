<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Country;
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
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'title' => $this->faker->title(),
            'city' => $this->faker->city(),
            'country_id' => Country::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()->id,
            'summary'=>$this->faker->paragraph(7),
            'experience'=>$this->exp(),
            'education'=>$this->edu(),
            'level'=>  (Country::inRandomOrder()->first()->id % 2) ? 'Mid-Level':'Entry-Level',
            'availability'=>(Country::inRandomOrder()->first()->id % 2) ? 'Full-Time':'Part-Time',

        ];
    }
    public function exp()
    {
        $values = array();
        for ($i = 0; $i < 5; $i++) {
            $values []= ["company"=>$this->faker->company(), "title"=>$this->faker->sentence(), "description"=>$this->faker->paragraph(3)];
        }
        return $values;
    }
    public function edu()
    {
        $values = array();
        for ($i = 0; $i < 2; $i++) {
            $values []= ["school"=>$this->faker->sentence(3), "course"=>$this->faker->sentence(3), "year"=>$this->faker->year()."-".$this->faker->year()];
        }
        return $values;
    }
}
