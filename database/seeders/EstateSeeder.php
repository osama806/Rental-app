<?php

namespace Database\Seeders;

use App\Models\RealEstate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RealEstate::truncate();
        $csvFile = fopen(base_path("database/csv/House-Dataset.csv"), "r");
        $firstLine = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== false) {
            if (!$firstLine) {
                RealEstate::create([
                    "broker"            =>      $data['0'],
                    "type"              =>      $data['1'],
                    "price"             =>      $data['2'],
                    "beds"              =>      $data['3'],
                    "paths"             =>      $data['4'],
                    "address"           =>      $data['5'],
                    "state"             =>      $data['6'],
                    "locality"          =>      $data['7'],
                    "sub_locality"      =>      $data['8'],
                    "street_name"       =>      $data['9']
                ]);
            }
            $firstLine = false;
        }
        fclose($csvFile);
    }
}
