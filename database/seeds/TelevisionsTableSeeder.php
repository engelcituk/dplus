<?php

use Illuminate\Database\Seeder;
use App\Television;

class TelevisionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Television::truncate();// limpio la tabla

        $servicio = new Television;
        $servicio->name="VeTV 135";
        $servicio->days_periods_id=3;
        $servicio->description="VeTV el más básico";
        $servicio->price=135;
        $servicio->commission=16;
        $servicio->final_price=151;
        $servicio->save();

        $servicio = new Television;
        $servicio->name="Sky/VeTV 185";
        $servicio->days_periods_id=3;
        $servicio->description="VeTV básico nivel 2";
        $servicio->price=185;
        $servicio->commission=16;
        $servicio->final_price=201;
        $servicio->save();

        $servicio = new Television;
        $servicio->name="Sky/VeTV 235";
        $servicio->days_periods_id=3;
        $servicio->description="VeTV plus";
        $servicio->price=235;
        $servicio->commission=16;
        $servicio->final_price=251;
        $servicio->save();
    }
}