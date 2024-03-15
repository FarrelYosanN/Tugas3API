<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Person;

class PeopleTableSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            Person::create([
                'name' => 'Person ' . $i,
                'age' => rand(20, 50),
                'email' => 'person' . $i . '@example.com',
                'address' => 'Address ' . $i . ', City',
            ]);
        }
    }
}
