<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('skills')->delete();
        $skills = array(
         array('id' => '1', 'category_id'=>4, 'title'=>'UI DESIGN', 'description'=>'This is the UI DESIGN category'),
         array('id' => '2', 'category_id'=>4, 'title'=>'UX DESIGN', 'description'=>'This is the UX DESIGN category'),
         array('id' => '3', 'category_id'=>4, 'title'=>'INTERACTIVE DESIGN', 'description'=>'This is the INTERACTIVE DESIGN category'),
         array('id' => '4', 'category_id'=>4, 'title'=>'TECHNICAL WRITING', 'description'=>'This is the INTERACTIVE DESIGN category'),
         array('id' => '5', 'category_id'=>4, 'title'=>'UX WRITING', 'description'=>'This is the UX WRITING category'),
         array('id' => '6', 'category_id'=>1, 'title'=>'FRONT-END WEB DEVELOPMENT', 'description'=>'This is the FRONT-END WEB DEVELOPMENT category'),
         array('id' => '7', 'category_id'=>1, 'title'=>'BACK-END WEB DEVELOPMENT', 'description'=>'This is the BACK-END WEB DEVELOPMENT category'),
         array('id' => '8', 'category_id'=>1, 'title'=>'API DEVELOPMENT', 'description'=>'This is the API DEVELOPMENT category'),
         array('id' => '9', 'category_id'=>1, 'title'=>'MACHINE LEARNING', 'description'=>'This is the MACHINE LEARNING category'),
         array('id' => '10', 'category_id'=>1, 'title'=>'AI', 'description'=>'This is the AI category'),
        );

        DB::table('skills')->insert($skills);
    }
}
