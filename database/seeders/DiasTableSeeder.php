<?php

namespace Database\Seeders;

use App\Models\Dias;
use Illuminate\Database\Seeder;

class DiasTableSeeder extends Seeder
{
    public function run()
    {
        $days = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];

        foreach ($days as $day) {
            Dias::create(['Dia' => $day]);
    }
}
}