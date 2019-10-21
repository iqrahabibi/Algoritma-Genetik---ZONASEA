<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vessel;
use App\Cargo;
use GuzzleHttp\Client;
use DB;

class AlgenController extends Controller
{
    private $data = null;
    private $inisialisasi = null;

    public function inisialisasi_awal(Request $request)
    {
        // echo "cek";
        // inisialisasi awal
        $waktu = null;
        $jarak = null;
        
        $vessel = Vessel::findOrFail($request->id);
        // $vessel = Vessel::get();
        // dd($vessel);
        $cargos = new Cargo();
        // dd($cargos);
            // $jarak[$key] = $this->hitungJarak($vessel->lat,$vessel->lng,$value->lng, $value->lng, 'nmi', 0);
            // $waktu[$key] = $vessel->speed / $jarak[$key];
            
        for ($j = 0; $j < 10 ; $j++) {
            $capacity = 0;
            foreach ($cargos->inRandomOrder()->get() as $key => $cargo){
                // dd($cargo);    
                $capacity+=$cargo->qty;
                // echo $capacity; exit;
                if ($capacity <= $vessel->max_capacity) {
                    $this->inisialisasi[$j][$key] = 1;
                    $this->data[$j][$key] = $cargo->id;
                } else {
                    $this->inisialisasi[$j][$key] = 0;
                    $this->data[$j][$key] = $cargo->id;
                }
                
            }
            
        }
// echo count($this->data); exit;
        // hitung fitnes
        $data_capacity = null;
        
        for ($i = 0; $i < count($this->data) ; $i++) {
            
            $capacity = 0;
            for ($j = 0; $j < count($this->data) ; $j++) {
                // echo count($this->data);
                // dd($this->data[$i][$j]);
                $cargo2 = Cargo::find($this->data[$i][$j]);
                echo $cargo2->id.",";
                
                echo $this->data[$i][$j].",";
                echo $this->inisialisasi[$i][$j];
                echo "\n";

                if ($cargo2->id == $this->data[$i][$j] && $this->inisialisasi[$i][$j] == 1) {
                    $capacity+=$cargo2->qty;
                }
                // echo $j; 
                if($j == 4){
                    exit;
                }
            }
            
            $data_capacity[$i] = $capacity;
            echo $data_capacity[$i]; exit;
        }

        // CrossOver
        $hasil_crossover = null;
        $hasil_crossover_data = null;
        $anak1 = 0;
        $anak2 = 1;
        foreach ($this->inisialisasi as $key => $value) {
            $titik = 0;
            $titik = array_rand($value);
            if ($anak1 < count($this->inisialisasi) && $anak2 < count($this->inisialisasi)) {
                foreach ($value as $key2 => $value2) {
                    if ($key2 >= $titik) {
                        $hasil_crossover[$anak1][$key2] = $this->inisialisasi[$anak2][$key2];
                        $hasil_crossover[$anak2][$key2] = $this->inisialisasi[$anak1][$key2];
                        $hasil_crossover_data[$anak1][$key2] = $this->data[$anak2][$key2];
                        $hasil_crossover_data[$anak2][$key2] = $this->data[$anak1][$key2];
                    } else {
                        $hasil_crossover[$anak1][$key2] = $this->inisialisasi[$anak1][$key2];
                        $hasil_crossover[$anak2][$key2] = $this->inisialisasi[$anak2][$key2];
                        $hasil_crossover_data[$anak1][$key2] = $this->data[$anak1][$key2];
                        $hasil_crossover_data[$anak2][$key2] = $this->data[$anak2][$key2];
                    }
                }
            }
            $anak1+=2;
            $anak2+=2;
        }

        // Mutasi
        $jumlah_gen = count($this->inisialisasi) * count($this->inisialisasi[0]);
        $jumlah_titik = $jumlah_gen * 0.01;
        $hasil_mutasi = null;
        foreach ($hasil_crossover as $key => $value) {
            $titik = array_rand($value);
            foreach ($value as $key2 => $value2) {
                if ($key < (int)$jumlah_titik && $key2 == $titik) {
                    $hasil_mutasi[$key][$titik] = ($hasil_crossover[$key][$titik] == 0) ? 1 : 0;
                } else {
                    $hasil_mutasi[$key][$key2] = $value2;
                }
            }
        }

        // Seleksi Individu Baru
        $hasil_seleksi_baru = null;
        $hasil_seleksi_baru_data = null;
        for ($i = 0; $i < count($hasil_mutasi); $i++) {
            $hasil_fitnes_offspring = 0;
            for ($j = 0; $j < count($hasil_mutasi); $j++) {
                if ($hasil_mutasi[$i][$j] == 1) {
                    $cargo_offspring = Cargo::find($hasil_crossover_data[$i][$j]);
                    $hasil_fitnes_offspring += $cargo_offspring->capacity;
                }
            }
            if ($hasil_fitnes_offspring <= $vessel->max_capacity) {
                $hasil_seleksi_baru[$i] = $hasil_mutasi[$i];
                $hasil_seleksi_baru_data[$i] = $hasil_crossover_data[$i];
            }
        }

        // Menampilkan hasil Algoritma
        $data_cargo = null;
        foreach ($hasil_seleksi_baru_data as $key => $value) {
            foreach ($value as $key2 => $value2) {
                if ($hasil_seleksi_baru[$key][$key2] == 1) {
                    $data_cargo[$key][$key2] = Cargo::findOrFail($value2);
                }
            }
        }
        
        return response()->json($data_cargo);
        // return array("Pengkodean" => $this->inisialisasi, "Id" => $this->data, "Titik" => $titik, "Hasil Cross Over" => $hasil_crossover, "Hasil Mutasi" => $hasil_mutasi, "Seleksi Baru" => $hasil_seleksi_baru);
    }

    private function hitungJarak($lat1, $lon1, $lat2, $lon2, $unit = 'km', $desimal = 2) {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;

        switch($unit) {
            case "km":
                $jarak = $miles * 1.609344;
                break;
            case "nmi":
                $jarak = $miles * 0.8684;
                break;
            default :
                $jarak = $miles;
                break;
        }

        return round($jarak, $desimal);
    }
}
