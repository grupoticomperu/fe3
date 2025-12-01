<?php

namespace App\Exports;

use App\Models\Brand;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Excel;
use Illuminate\Contracts\Support\Responsable;


class BrandExport implements FromCollection, WithCustomStartCell, Responsable
{
    use Exportable;
    private $fileName = 'marcas.xlsx';//si quieres guardar en csv pones  marcas.csv
    private $writerType = Excel::XLSX;//si quieres en csv pones CSV

    public function collection()
    {
        //return Brand::all();
        return Brand::where('company_id', auth()->user()->employee->company->id)->get();
    }

    public function startCell(): string
    {
        return 'A10';
    }
}
