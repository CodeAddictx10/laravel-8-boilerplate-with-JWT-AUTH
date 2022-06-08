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
            array('id' => '1', 'category_id'=>1, 'title'=>'Backend Web Development', 'description'=>'This is the Backend Web Development category'),
            array('id' => '2', 'category_id'=>1, 'title'=>'Mobile Application Development', 'description'=>'This is the Mobile Application Development category'),
            array('id' => '3', 'category_id'=>1, 'title'=>'Frontend Web Development', 'description'=>'This is the Frontend Web Development category'),
            array('id' => '4', 'category_id'=>1, 'title'=>'Quality Assurance', 'description'=>'This is the Quality Assurance category'),
            array('id' => '5', 'category_id'=>1, 'title'=>'Data Analytics', 'description'=>'This is the Data Analytics category'),
            array('id' => '6', 'category_id'=>2, 'title'=>'Digital Marketing', 'description'=>'This is the Digital Marketing category'),
            array('id' => '7', 'category_id'=>2, 'title'=>'Content creation', 'description'=>'This is the Content creation category'),
            array('id' => '8', 'category_id'=>2, 'title'=>'Email marketing', 'description'=>'This is the Email marketing category'),
            array('id' => '9', 'category_id'=>2, 'title'=>'Social media management', 'description'=>'This is the Social media management category'),
            array('id' => '10', 'category_id'=>3, 'title'=>'Graphic Design', 'description'=>'This is the Graphic Design category'),
            array('id' => '11', 'category_id'=>3, 'title'=>'Video Animation', 'description'=>'This is the Video Animation category'),
            array('id' => '12', 'category_id'=>3, 'title'=>'Motion Graphics', 'description'=>'This is the Motion Graphics category'),
            array('id' => '13', 'category_id'=>3, 'title'=>'UI/UX', 'description'=>'This is the UI/UX category'),
            array('id' => '14', 'category_id'=>4, 'title'=>'Product Management', 'description'=>'This is the Product Management category'),
            array('id' => '15', 'category_id'=>4, 'title'=>'Product Design(UI/UX)', 'description'=>'This is the Product Design(UI/UX) category'),
            array('id' => '16', 'category_id'=>4, 'title'=>'Data Analytics', 'description'=>'This is the Data Analytics category'),
            array('id' => '17', 'category_id'=>5, 'title'=>'CRM', 'description'=>'This is the CRM category'),
            array('id' => '18', 'category_id'=>5, 'title'=>'Data Analytics', 'description'=>'This is the Data Analytics category'),
            array('id' => '19', 'category_id'=>5, 'title'=>'Microsoft Office Suite', 'description'=>'This is the Microsoft Office Suite category'),
        );
        DB::table('skills')->insert($skills);
    }
}