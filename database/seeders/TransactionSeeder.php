<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Atm;
use App\Models\Transaction;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua ATM yang ada di database
        $atms = Atm::all();

        // Loop untuk setiap ATM
        foreach ($atms as $atm) {
            // Buat 200 data transaksi bohongan untuk setiap ATM
            for ($i = 0; $i < 200; $i++) {
                Transaction::create([
                    'atm_id' => $atm->id,
                    'transaction_date' => now()->subDays(rand(1, 365))->subHours(rand(1, 24)),
                    'amount' => rand(1, 20) * 50000, // Kelipatan 50rb, dari 50rb - 1jt
                    'type' => 'withdrawal',
                ]);
            }
        }
    }
}
