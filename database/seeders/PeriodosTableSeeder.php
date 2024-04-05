<?php

namespace Database\Seeders;

use App\Models\Periodos;
use Illuminate\Database\Seeder;

class PeriodosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $periodos = ['06:45 - 08:15','08:15 - 09:45','09:45 - 11:15','11:15 - 12:45','12:45 - 14:15','14:15 - 15:45','15:45 - 17:15','17:15 - 18:45','18:45 - 20:15','20:15 - 21:45',];
        
        foreach ($periodos as $periodo) {
            Periodos::create(['HoraIntervalo' => $periodo]);
        }
    }
}
