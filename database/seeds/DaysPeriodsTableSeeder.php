<?php

use Illuminate\Database\Seeder;
use App\DaysPeriod;

class DaysPeriodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DaysPeriod::truncate();// limpio la tabla

        $servicio = new DaysPeriod;
        $servicio->days_number=0;
        $servicio->description="No aplica recurrencia";
        $servicio->save();

        $servicio = new DaysPeriod;
        $servicio->days_number=15;
        $servicio->description="Pago quincenal";
        $servicio->save();

        $servicio = new DaysPeriod;
        $servicio->days_number=30;
        $servicio->description="Pago mensual, cada 30 días";
        $servicio->save();
    }
}
