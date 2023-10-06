<?php

namespace Database\Seeders;

use App\Models\Variation;
use Illuminate\Database\Seeder;

class VariationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Variation::factory()->count(100)->create();

    }
}
