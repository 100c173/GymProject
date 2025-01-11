<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

     DB::table('plan_types')->insert([

      'name'=>'karateh',

     ]);

     DB::table('plan_types')->insert([

        'name'=>'karateh',
  
       ]);
  
    }
}
