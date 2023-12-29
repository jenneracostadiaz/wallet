<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Currency::create([
            'name' => 'Soles',
            'symbol' => 'S/',
            'code' => 'PEN',
        ]);

        Currency::create([
            'name' => 'Dólares',
            'symbol' => '$',
            'code' => 'USD',
        ]);

        Currency::create([
            'name' => 'Euros',
            'symbol' => '€',
            'code' => 'EUR',
        ]);
    }
}
