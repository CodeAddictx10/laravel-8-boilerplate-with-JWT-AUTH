<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->delete();
        $categories = array(
         array('id' => '1', 'title'=>'Engineering and Programming', 'description'=>'This is the Engineering and Programming category'),
         array('id' => '2', 'title'=>'Marketing and Communications', 'description'=>'This is the Marketing and Communications category'),
         array('id' => '3', 'title'=>'Design and Animation', 'description'=>'This is the Design and Animation category'),
         array('id' => '4', 'title'=>'Product', 'description'=>'This is the Product category'),
         array('id' => '5', 'title'=>'Data & Customer Support', 'description'=>'This is the Data & Customer Support category'),
        );
        DB::table('categories')->insert($categories);
    }
}
