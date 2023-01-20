<?php

namespace App\Exports;

use App\Models\V_produksi_pendapatan_cus;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Pemilik_Barang_Eksportir_Agent implements FromCollection, WithCustomCsvSettings, WithHeadings
{

    function __construct($agent, $start_date, $end_date) {
        $this->agent = $agent;
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
            "TAHUN",
            "BULAN",
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
        return V_produksi_pendapatan_cus::select(\DB::raw("agent,nama_agent,lokasi,tahun,bulan,
            (JML_BOX_IMPORT_20*1+JML_BOX_EXPORT_20*1) AS JML_TEUS_20,
            (JML_BOX_IMPORT_40*1+JML_BOX_EXPORT_40*1) AS JML_TEUS_40,
            (JML_BOX_IMPORT_45*1+JML_BOX_EXPORT_45*1) AS JML_TEUS_45,
            (JML_TEUS_IMPORT+JML_TEUS_EXPORT) AS JML_TEUS_TOTAL,
            (TOTAL_PENDAPATAN) AS TOTAL_PENDAPATAN"))
        ->whereBetween('tanggal',[ $this->start_date, $this->end_date])->where('agent', $this->agent)
        ->orderBy(\DB::raw('tahun'))->orderBy(\DB::raw('bulan'))->get();
    }
}



