<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {

        $brands = [
            ['name' => 'Audi', 'country' => 'Germany'],
            ['name' => 'BMW', 'country' => 'Germany'],
            ['name' => 'Lexus', 'country' => 'Japan'],
            ['name' => 'Toyota', 'country' => 'Japan'],
            ['name' => 'Ford', 'country' => 'USA'],
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }

    }
}
