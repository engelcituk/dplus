<?php

use Illuminate\Database\Seeder;
use App\Servicio;

class ServiciosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Servicio::truncate();// limpio la tabla

        $servicio = new Servicio;
        $servicio->name="Sky/VeTV";
        $servicio->category_id=1;
        $servicio->days_periods_id=3;
        $servicio->description="VeTV el más básico";
        $servicio->price=135;
        $servicio->commission=16;
        $servicio->assurance=0;
        $servicio->final_price=151;
        $servicio->save();

        $servicio = new Servicio;
        $servicio->name="Sky/VeTV";
        $servicio->category_id=1;
        $servicio->days_periods_id=3;
        $servicio->description="VeTV básico nivel 2";
        $servicio->price=185;
        $servicio->commission=16;
        $servicio->assurance=0;
        $servicio->final_price=201;
        $servicio->save();

        $servicio = new Servicio;
        $servicio->name="Sky/VeTV";
        $servicio->category_id=1;
        $servicio->days_periods_id=3;
        $servicio->description="VeTV plus";
        $servicio->price=235;
        $servicio->commission=16;
        $servicio->assurance=0;
        $servicio->final_price=251;
        $servicio->save();

        $servicio = new Servicio;
        $servicio->name="Internet";
        $servicio->category_id=3;
        $servicio->days_periods_id=3;
        $servicio->description="Internet de 2 megas";
        $servicio->price=250;
        $servicio->commission=0;
        $servicio->assurance=30;
        $servicio->final_price=280;
        $servicio->save();

        $servicio = new Servicio;
        $servicio->name="Internet";
        $servicio->category_id=3;
        $servicio->days_periods_id=3;
        $servicio->description="Internet de 3 megas";
        $servicio->price=300;
        $servicio->commission=0;
        $servicio->assurance=40;
        $servicio->final_price=340;
        $servicio->save();
    }
}
