<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\table;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            
        DB::table('users')->insert([

            'name'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=>bcrypt('12345678'),
        ]);

    }
}
