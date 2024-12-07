<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;


class TrainerSeeder extends Seeder
{
    public function run()
    {        
        $trainers = [
            [
                'first_name' => 'Trainer',
                'last_name' => 'One',

                'email' => 'trainer1@example.com',
                'password' => bcrypt('password'),
            ],
            [
                'first_name' => 'Trainer',
                'last_name' => 'Two',
                'email' => 'trainer2@example.com',
                'password' => bcrypt('password'),
            ],
        ];

        // 
        foreach ($trainers as $trainerData) {
            $user = User::firstOrCreate(['email' => $trainerData['email']], $trainerData);
            $user->assignRole('trainer'); 
        }
    }
}
