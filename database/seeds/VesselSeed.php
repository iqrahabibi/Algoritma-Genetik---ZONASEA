<?php

use Illuminate\Database\Seeder;
use App\Vessel;

class VesselSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vessel::insert([
            ['name_vessels' => 'Vessel 1', 'max_capacity' => 4000, 'min_capacity' => 2000, 'lat' => -3.816282, 'lng' => 105.9379663],
            ['name_vessels' => 'Vessel 2', 'max_capacity' => 5000, 'min_capacity' => 2500, 'lat' => -6.330864, 'lng' => 108.3697063],
        ]);
    }
}
