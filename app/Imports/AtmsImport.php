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
            $atm = Atm::where('terminal_id', $row['terminal_id'])->first();

            if ($atm) {
                $atm->statuses()->create([
                    'sheets_out'   => $row['lembar_keluar'],
                    'problem_code' => $row['problem'],
                    'reported_at'  => now(),
                ]);
            }
        }
    }
}
