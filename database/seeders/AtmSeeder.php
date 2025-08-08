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
        // ATM-001: 1 Tipe Denominasi, 4 Kaset Penuh
        $atm1 = Atm::create([
            'terminal_id' => 'ATM-001',
            'location_name' => 'Supermarket ADA',
            'type' => 'ATM',
            'status' => 'active',
        ]);
        $atm1->cassettes()->create([
            'denomination' => 100000,
            'max_sheets' => 8000, // Standar 4 kaset x 2000 lembar
            'current_sheets' => 8000,
            'status' => 'OK',
        ]);

        // CRM-001: 2 Tipe Denominasi, Masing-masing 2 Kaset
        $crm1 = Atm::create([
            'terminal_id' => 'CRM-001',
            'location_name' => 'Mall Paragon',
            'type' => 'CRM',
            'status' => 'active',
        ]);
        $crm1->cassettes()->createMany([
            ['denomination' => 100000, 'max_sheets' => 4000, 'current_sheets' => 4000, 'status' => 'OK'], // 2 kaset 100rb
            ['denomination' => 50000, 'max_sheets' => 4000, 'current_sheets' => 4000, 'status' => 'OK'], // 2 kaset 50rb
        ]);

        // ATM-002: 1 Tipe Denominasi, 2 Kaset
        $atm2 = Atm::create([
            'terminal_id' => 'ATM-002',
            'location_name' => 'SPBU Kalibanteng',
            'type' => 'ATM',
            'status' => 'maintenance',
        ]);
        $atm2->cassettes()->create([
            'denomination' => 50000,
            'max_sheets' => 4000, // Standar 2 kaset x 2000 lembar
            'current_sheets' => 4000,
            'status' => 'LOW',
        ]);
    }
}
