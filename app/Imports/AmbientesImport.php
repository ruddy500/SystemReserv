<?php

namespace App\Imports;

use App\Models\Ambientes;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class AmbientesImport implements ToModel,WithStartRow
{

    // Especifica que deseas empezar a leer desde la fila 2
    public function startRow(): int
    {
        return 2;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Ambientes([
            'Ubicacion' => $row[0], //a
            'Capacidad' => $row[1], //b
            'nombre_ambientes_id' =>$row[2],
            'tipo_ambientes_id' =>$row[3],

        ]);
    }
}
