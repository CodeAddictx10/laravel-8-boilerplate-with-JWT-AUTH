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
         array('id' => '1', 'title'=>'Engineering', 'description'=>'This is the Engineering category'),
         array('id' => '2', 'title'=>'Marketing', 'description'=>'This is the Marketing category'),
         array('id' => '3', 'title'=>'Design', 'description'=>'This is the Design category'),
         array('id' => '4', 'title'=>'Product', 'description'=>'This is the Product category'),
        );

        DB::table('categories')->insert($categories);
    }
}
