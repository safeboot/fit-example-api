<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {

        $cars = [
            ['model' => 'M5', 'year' => 2021, 'price' => 150000.00, 'brand_id' => 2],
            ['model' => 'A6', 'year' => 2021, 'price' => 120000.00, 'brand_id' => 1],
            ['model' => 'LFA', 'year' => 2021, 'price' => 100000.00, 'brand_id' => 3],
            ['model' => 'Corolla Hybrid', 'year' => 2021, 'price' => 85500.00, 'brand_id' => 4],
            ['model' => 'F150', 'year' => 2021, 'price' => 70000.00, 'brand_id' => 5],
        ];

        foreach ($cars as $car) {
            Car::create($car);
        }

    }
}
