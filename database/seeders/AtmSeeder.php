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
        // Buat ATM Tipe Mono-Denominasi (1 Cassette)
        $atm1 = Atm::create([
            'terminal_id' => 'ATM-001',
            'location_name' => 'Supermarket ADA',
            'address' => 'Jl. Pahlawan No. 1',
            'type' => 'ATM',
            'status' => 'active',
        ]);
        // Buat Cassette untuk ATM-001
        $atm1->cassettes()->create([
            'denomination' => 100000,
            'max_sheets' => 8000,
        ]);

        // Buat ATM Tipe CRM (2 Cassette)
        $crm1 = Atm::create([
            'terminal_id' => 'CRM-001',
            'location_name' => 'Mall Paragon',
            'address' => 'Jl. Pemuda No. 10',
            'type' => 'CRM',
            'status' => 'active',
        ]);
        // Buat Cassette untuk CRM-001
        $crm1->cassettes()->createMany([
            ['denomination' => 100000, 'max_sheets' => 4000],
            ['denomination' => 50000, 'max_sheets' => 4000],
        ]);

        // Buat ATM yang sedang maintenance
        $atm2 = Atm::create([
            'terminal_id' => 'ATM-002',
            'location_name' => 'SPBU Kalibanteng',
            'address' => 'Jl. Siliwangi No. 50',
            'type' => 'ATM',
            'status' => 'maintenance',
        ]);
        // Buat Cassette untuk ATM-002
        $atm2->cassettes()->create([
            'denomination' => 50000,
            'max_sheets' => 8000,
        ]);
    }
}
