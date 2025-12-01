<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    // Función para eliminar tildes
    private function removeAccents($text)
    {
        $unwanted_array = array(
            'Á' => 'A', 'À' => 'A', 'Â' => 'A', 'Ä' => 'A', 'Ã' => 'A', 'Å' => 'A', 'Ā' => 'A',
            'Ă' => 'A', 'Ą' => 'A', 'á' => 'a', 'à' => 'a', 'â' => 'a', 'ä' => 'a', 'ã' => 'a',
            'å' => 'a', 'ā' => 'a', 'ă' => 'a', 'ą' => 'a', 'É' => 'E', 'È' => 'E', 'Ê' => 'E',
            'Ë' => 'E', 'Ē' => 'E', 'Ĕ' => 'E', 'Ė' => 'E', 'Ę' => 'E', 'Ě' => 'E', 'é' => 'e',
            'è' => 'e', 'ê' => 'e', 'ë' => 'e', 'ē' => 'e', 'ĕ' => 'e', 'ė' => 'e', 'ę' => 'e',
            'ě' => 'e', 'Í' => 'I', 'Ì' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ĩ' => 'I', 'Ī' => 'I',
            'Ĭ' => 'I', 'Į' => 'I', 'İ' => 'I', 'í' => 'i', 'ì' => 'i', 'î' => 'i', 'ï' => 'i',
            'ĩ' => 'i', 'ī' => 'i', 'ĭ' => 'i', 'į' => 'i', 'ı' => 'i', 'Ó' => 'O', 'Ò' => 'O',
            'Ô' => 'O', 'Ö' => 'O', 'Õ' => 'O', 'Ø' => 'O', 'Ō' => 'O', 'Ŏ' => 'O', 'Ő' => 'O',
            'ó' => 'o', 'ò' => 'o', 'ô' => 'o', 'ö' => 'o', 'õ' => 'o', 'ø' => 'o', 'ō' => 'o',
            'ŏ' => 'o', 'ő' => 'o', 'Ú' => 'U', 'Ù' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ũ' => 'U',
            'Ū' => 'U', 'Ŭ' => 'U', 'Ů' => 'U', 'Ű' => 'U', 'Ų' => 'U', 'ú' => 'u', 'ù' => 'u',
            'û' => 'u', 'ü' => 'u', 'ũ' => 'u', 'ū' => 'u', 'ŭ' => 'u', 'ů' => 'u', 'ű' => 'u',
            'ų' => 'u', 'Ý' => 'Y', 'Ÿ' => 'Y', 'Ŷ' => 'Y', 'ý' => 'y', 'ÿ' => 'y', 'ŷ' => 'y',
            'Ç' => 'C', 'Č' => 'C', 'Ć' => 'C', 'Ĉ' => 'C', 'Ċ' => 'C', 'ç' => 'c', 'č' => 'c',
            'ć' => 'c', 'ĉ' => 'c', 'ċ' => 'c', 'Ñ' => 'N', 'Ń' => 'N', 'Ň' => 'N', 'Ņ' => 'N',
            'Ŋ' => 'N', 'ñ' => 'n', 'ń' => 'n', 'ň' => 'n', 'ņ' => 'n', 'ŋ' => 'n', 'Š' => 'S',
            'Ś' => 'S', 'Ŝ' => 'S', 'Ş' => 'S', 'š' => 's', 'ś' => 's', 'ŝ' => 's', 'ş' => 's',
            'Ž' => 'Z', 'Ź' => 'Z', 'Ż' => 'Z', 'Ž' => 'Z', 'ž' => 'z', 'ź' => 'z', 'ż' => 'z',
            'ž' => 'z'
        );
        return strtr($text, $unwanted_array);
    }

    // Función para actualizar la columna name2
    public function updateName2()
    {
        // Obtener todos los registros de la tabla departments
        $departments = DB::table('departments')->get();

        // Actualizar cada registro de departamento
        foreach ($departments as $department) {
            $name2 = $this->removeAccents($department->name);
            DB::table('departments')
                ->where('id', $department->id)
                ->update(['name2' => $name2]);
        }


        // Obtener todos los registros de la tabla departments
        $provinces = DB::table('provinces')->get();
        // Actualizar cada registro de provincia
        foreach ($provinces as $province) {
            $name2 = $this->removeAccents($province->name);
            DB::table('provinces')
                ->where('id', $province->id)
                ->update(['name2' => $name2]);
        }

        // Obtener todos los registros de la tabla departments
        $districts = DB::table('districts')->get();
        // Actualizar cada registro de provincia
        foreach ($districts as $district) {
            $name2 = $this->removeAccents($district->name);
            DB::table('districts')
                ->where('id', $district->id)
                ->update(['name2' => $name2]);
        }


        return response()->json(['message' => 'Column name2 de departamento, provincia y distrito updated successfully!']);
    }
}
