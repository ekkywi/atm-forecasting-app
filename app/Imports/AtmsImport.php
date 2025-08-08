<?php

namespace App\Imports;

use App\Models\Atm;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AtmsImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Cari ATM berdasarkan terminal_id
            $atm = Atm::where('terminal_id', $row['terminal_id'])->with('cassettes')->first();

            if ($atm) {
                // Loop untuk 4 kaset (bisa disesuaikan)
                for ($i = 1; $i <= 4; $i++) {
                    // Cek apakah ada data untuk kaset ke-i di file CSV
                    if (isset($row['c' . $i . '_sheets']) && isset($row['c' . $i . '_status'])) {

                        // Ambil kaset ke-i dari ATM yang bersangkutan
                        // NOTE: Ini mengasumsikan urutan kaset di database sama
                        $cassette = $atm->cassettes[$i - 1] ?? null;

                        if ($cassette) {
                            // Update saldo dan status kaset tersebut
                            $cassette->update([
                                'current_sheets' => $row['c' . $i . '_sheets'],
                                'status' => $row['c' . $i . '_status'],
                            ]);
                        }
                    }
                }
            }
        }
    }
}
