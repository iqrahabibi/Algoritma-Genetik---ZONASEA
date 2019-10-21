<?php

use Illuminate\Database\Seeder;
use App\Cargo;

class CargoSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cargo::insert([
            ['name_cargo' => 'cargo 1', 'capacity' => 1000, 'lat' => -1.3009914,'lng' => 104.0941118],
            ['name_cargo' => 'cargo 2', 'capacity' => 900, 'lat' => -1.9923931,'lng' => 104.2492928],
            ['name_cargo' => 'cargo 3', 'capacity' => 800, 'lat' => 0.2919583,'lng' => 103.5035678],
            ['name_cargo' => 'cargo 4', 'capacity' => 700, 'lat' => 3.7756958,'lng' => 98.7028754],
            ['name_cargo' => 'cargo 5', 'capacity' => 600, 'lat' => 5.5668245,'lng' => 95.2954422],
            ['name_cargo' => 'cargo 6', 'capacity' => 500, 'lat' => -5.2139495,'lng' => 105.7588652],
            ['name_cargo' => 'cargo 7', 'capacity' => 1100, 'lat' => -6.1037256,'lng' => 106.1324742],
            ['name_cargo' => 'cargo 8', 'capacity' => 1200, 'lat' => -6.1452312,'lng' => 106.8052961],
            ['name_cargo' => 'cargo 9', 'capacity' => 1300, 'lat' => -6.228545,'lng' => 108.1892513],
            ['name_cargo' => 'cargo 10', 'capacity' => 1400, 'lat' => -6.7948692,'lng' => 109.5028252],
            ['name_cargo' => 'cargo 11', 'capacity' => 1500, 'lat' => -7.0245542,'lng' => 110.347024],
            ['name_cargo' => 'cargo 12', 'capacity' => 1600, 'lat' => -6.8168127,'lng' => 111.8076803],
            ['name_cargo' => 'cargo 13', 'capacity' => 1700, 'lat' => -7.2754438,'lng' => 112.6426426],
            ['name_cargo' => 'cargo 14', 'capacity' => 1800, 'lat' => -7.7168478,'lng' => 113.9278533],
            ['name_cargo' => 'cargo 15', 'capacity' => 1900, 'lat' => -7.1236406,'lng' => 113.8733956],
            ['name_cargo' => 'cargo 16', 'capacity' => 2000, 'lat' => -1.8662824,'lng' => 109.9421177],
            ['name_cargo' => 'cargo 17', 'capacity' => 2100, 'lat' => 0.3929477,'lng' => 108.9190046],
            ['name_cargo' => 'cargo 18', 'capacity' => 2200, 'lat' => -3.8323147,'lng' => 114.6067104],
            ['name_cargo' => 'cargo 19', 'capacity' => 2300, 'lat' => -5.1134507,'lng' => 119.4076663],
            ['name_cargo' => 'cargo 20', 'capacity' => 2400, 'lat' => -5.2684467,'lng' => 123.1200433],
        ]);
    }
}
