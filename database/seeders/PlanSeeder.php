<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('plans')->insert([

            'name'=>'PlanA',
            'description'=>'this first plan',
            'price'=>50,
            'with_trainer'=>true,
            'period'=>60,
            'plan_type_id'=>1,
            
        ]);
        DB::table('plans')->insert([

            'name'=>'PlanB',
            'description'=>'this second plan',
            'price'=>30,
            'with_trainer'=>true,
            'period'=>120,
            'plan_type_id'=>2,
            
        ]);

    }
}
