<?php

namespace App\Exports;

use App\Models\V_produksi_pendapatan_cus;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MLO implements FromCollection, WithCustomCsvSettings, WithHeadings
{

    function __construct($lokasi, $start_date, $end_date) {
        $this->lokasi = $lokasi;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }


    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }

    public function headings(): array
    {
        return [
            "AGENT",                   
            "NAMA AGENT",
            "LOKASI",
            "TEUS 20%",
            "TEUS 40%",
            "TEUS 45%",
            "TOTAL",
            "PENDAPATAN (IDR)",
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return V_produksi_pendapatan_cus::select(\DB::raw("agent,nama_agent,lokasi,
            SUM(JML_BOX_IMPORT_20*1+JML_BOX_EXPORT_20*1) AS JML_TEUS_20,
            SUM(JML_BOX_IMPORT_40*1+JML_BOX_EXPORT_40*1) AS JML_TEUS_40,
            SUM(JML_BOX_IMPORT_45*1+JML_BOX_EXPORT_45*1) AS JML_TEUS_45,
            SUM(JML_TEUS_IMPORT+JML_TEUS_EXPORT) AS JML_TEUS_TOTAL,
            SUM(TOTAL_PENDAPATAN) AS TOTAL_PENDAPATAN"))
        ->where('lokasi', $this->lokasi)->whereBetween('tanggal',[ $this->start_date, $this->end_date])
        ->groupBy(\DB::raw('lokasi'),('agent'),('nama_agent'))->orderBy(\DB::raw('jml_teus_total'),'DESC')->get();
    }
}


