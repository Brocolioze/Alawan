<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnimalsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('animal')->insert([
            'idPerson' => 1,
            'idRace' => 1,
            'idCollier' => 1,
            'name' => Str::random(10),
            'picture' => Str::random(200),
            'birth' => date::random(),
            'research' => 1
        ]);
    }
}
