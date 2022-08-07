<?php

namespace App\Imports;

use App\Models\Alternatif;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AlternatifImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
        //dd($row);
        Alternatif::create([
            "nisn" => $row['nisn'],
            "nama_alternatif" => $row['nama_alternatif'],
        ]);
    }
}
}