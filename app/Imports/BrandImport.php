<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Brand;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class BrandImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        // Filtra registros en blanco antes de procesar
        $filteredRow = array_filter($row, function ($value) {
            return !empty($value);
        });

        // Verifica si todos los campos necesarios están presentes después de filtrar
        if (count($filteredRow) < 7) {
            return null; // Ignora la fila si no tiene todos los campos necesarios
        }


        return new Brand([
            'id' => $row[0],
            'name' => $row[1],
            'slug' => $row[2],
            'state' => $row[3],
            'image' => $row[4],
            //'created_at' => $row[5],
            //'updated_at' => $row[6],
            //'created_at' => Carbon::createFromFormat('d/m/Y', $row[5]), //si la fecha es formato texto en el excel
            'created_at' => Carbon::instance(Date::excelToDateTimeObject($row[5])), //si la fecha es formato fecha en el excel
            'updated_at' => Carbon::instance(Date::excelToDateTimeObject($row[6])), //si la fecha es formato fecha en el excel
        ]);
    }
}
