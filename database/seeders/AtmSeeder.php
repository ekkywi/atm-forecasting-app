<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Atm;

class AtmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Atm::create([
            'atm_id' => 'ATM-001',
            'location_name' => 'Supermarket ADA',
            'address' => 'Jl. Pahlawan No. 1',
            'status' => 'active',
            'max_capacity_100k' => 2000,
            'max_capacity_50k' => 0,
        ]);

        Atm::create([
            'atm_id' => 'CRM-001',
            'location_name' => 'Mall Paragon',
            'address' => 'Jl. Pemuda No. 10',
            'status' => 'active',
            'max_capacity_100k' => 2500,
            'max_capacity_50k' => 2500,
        ]);

        Atm::create([
            'atm_id' => 'ATM-002',
            'location_name' => 'SPBU Kalibanteng',
            'address' => 'Jl. Siliwangi No. 50',
            'status' => 'inactive',
            'max_capacity_100k' => 0,
            'max_capacity_50k' => 2000,
        ]);
    }
}
