<?php

namespace App\Exports;

use App\Models\Pegawai;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PegawaiExport implements FromView
{
   
    public function view(): View
    {
        $data = [
            'data' => Pegawai::getAllData()
        ];
        return view('export_pegawai', $data);
    }
}
