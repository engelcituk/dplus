<?php

use Illuminate\Database\Seeder;
use App\Internet;


class InternetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Internet::truncate();// limpio la tabla

        $servicio = new Internet;
        $servicio->name="Internet 1 mb";
        $servicio->days_periods_id=3;
        $servicio->description="De 1 mega de velocidad";
        $servicio->price=200;
        $servicio->assurance=30;
        $servicio->final_price=230;
        $servicio->save();

        $servicio = new Internet;
        $servicio->name="Internet 2 mb";
        $servicio->days_periods_id=3;
        $servicio->description=" de dos megas de velocidad";
        $servicio->price=250;
        $servicio->assurance=30;
        $servicio->final_price=280;
        $servicio->save();

        $servicio = new Internet;
        $servicio->name="Internet 3 mb";
        $servicio->days_periods_id=3;
        $servicio->description="de 3 megas de velocidad";
        $servicio->price=300;
        $servicio->assurance=50;
        $servicio->final_price=350;
        $servicio->save();
    }
}
