<?php

namespace Database\Seeders;

use App\Models\Office;
use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Office::factory()->has(Room::factory()->count(5))->create();
    }
}
