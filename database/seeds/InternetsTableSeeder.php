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

        $internet = new Internet;
        $internet->code="int1mb";
        $internet->name="Internet 1 mb";
        $internet->category_id=2;
        $internet->days_periods_id=3;
        $internet->description="De 1 mega de velocidad";
        $internet->price=200;
        $internet->assurance=30;
        $internet->final_price=230;
        $internet->iva=true;
        $internet->save();

        $internet = new Internet;
        $internet->code="int2mb";
        $internet->name="Internet 2 mb";
        $internet->category_id=2;
        $internet->days_periods_id=3;
        $internet->description=" de dos megas de velocidad";
        $internet->price=250;
        $internet->assurance=30;
        $internet->final_price=280;
        $internet->iva=true;
        $internet->save();

        $internet = new Internet;
        $internet->code="int3mb";
        $internet->name="Internet 3 mb";
        $internet->category_id=2;
        $internet->days_periods_id=3;
        $internet->description="de 3 megas de velocidad";
        $internet->price=300;
        $internet->assurance=50;
        $internet->final_price=350;
        $internet->iva=true;
        $internet->save();
    }
}
