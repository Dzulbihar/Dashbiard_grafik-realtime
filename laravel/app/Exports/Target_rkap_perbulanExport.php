<?php

namespace App\Exports;

use App\Models\V_target_rkap_perbulan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Target_rkap_perbulanExport implements FromCollection, WithCustomCsvSettings, WithHeadings
{
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }

    public function headings(): array
    {
        return [
            "ID",
            "Tahun",
            "Bulan",                
            "RKAP",
            "Satuan",           
            "Type",
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return V_target_rkap_perbulan::select(
            'id',
            'tahun',
            'bulan',                 
            'target_rkap',                    
            'satuan',
            'type', 
        )->orderBy('id', 'ASC')->get();
    }
}