<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestimonySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('testimonies')->delete();
        $testimonies = array(
         array('id' => '1', 'name'=>'Ioluwamichael Boss', 'company_icon'=>'https://flagcdn.com/32x24/za.png', 'description'=>'This is the Engineering category'),
         array('id' => '2', 'name'=>'Funke Adekunle', 'company_icon'=>'https://flagcdn.com/32x24/al.png', 'description'=>'This is the Marketing category'),
         array('id' => '3', 'name'=>'Adedoyin Life', 'company_icon'=>'https://flagcdn.com/32x24/af.png', 'description'=>'This is the Design category'),
         array('id' => '4', 'name'=>'EjaOfLagos', 'company_icon'=>'https://flagcdn.com/32x24/ng.png', 'description'=>'This is the Product category'),
        );

        DB::table('testimonies')->insert($testimonies);
    }
}
