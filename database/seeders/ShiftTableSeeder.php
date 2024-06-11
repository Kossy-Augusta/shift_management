<?php

namespace Database\Seeders;

use App\Models\Shift;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ShiftTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shifts =[
            ['title' => 'Morning', 'start_time'=> '08:00:00', 'end_time' => '18:00:00'],
            ['title' => 'Night', 'start_time'=> '18:00:00', 'end_time' => '08:00:00']
        ];

        foreach ($shifts as $shift)
        {
            Shift::create($shift);
        }
    }
}
