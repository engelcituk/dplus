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

        $tv = new Television;
        $tv->name="VeTV 135";
        $tv->category_id=1;
        $tv->days_periods_id=3;
        $tv->description="VeTV el más básico";
        $tv->code="135tv";
        $tv->price=135;
        $tv->commission=16;
        $tv->final_price=151;
        $tv->iva=true;
        $tv->save();

        $tv = new Television;
        $tv->name="Sky/VeTV 185";
        $tv->category_id=1;
        $tv->days_periods_id=3;
        $tv->description="VeTV básico nivel 2";
        $tv->code="185tv";
        $tv->price=185;
        $tv->commission=16;
        $tv->final_price=201;
        $tv->iva=true;
        $tv->save();

        $tv = new Television;
        $tv->name="Sky/VeTV 235";
        $tv->category_id=1;
        $tv->days_periods_id=3;
        $tv->description="VeTV plus";
        $tv->code="235tv";
        $tv->price=235;
        $tv->commission=16;
        $tv->final_price=251;
        $tv->iva=true;
        $tv->save();
    }
}
