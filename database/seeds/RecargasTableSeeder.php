<?php

use Illuminate\Database\Seeder;
use App\Recarga;


class RecargasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Recarga::truncate();// limpio la tabla

        $recarga = new Recarga;
        $recarga->code="4538645";
        $recarga->category_id=3;
        $recarga->description="Recarga de 10";
        $recarga->price=10;
        $recarga->commission=2;
        $recarga->iva=true;
        $recarga->final_price=12;
        $recarga->save();

        $recarga = new Recarga;
        $recarga->code="453865745";
        $recarga->category_id=3;
        $recarga->description="Recarga de 20";
        $recarga->price=20;
        $recarga->commission=2;
        $recarga->iva=true;
        $recarga->final_price=22;
        $recarga->save();

        $recarga = new Recarga;
        $recarga->code="45863845";
        $recarga->category_id=3;
        $recarga->description="Recarga de 30";
        $recarga->price=30;
        $recarga->commission=2;
        $recarga->iva=true;
        $recarga->final_price=32;
        $recarga->save();


        $recarga = new Recarga;
        $recarga->code="45368495";
        $recarga->category_id=3;
        $recarga->description="Recarga de 50";
        $recarga->price=50;
        $recarga->commission=2;
        $recarga->iva=true;
        $recarga->final_price=52;
        $recarga->save();

        $recarga = new Recarga;
        $recarga->code="45573495";
        $recarga->category_id=3;
        $recarga->description="Recarga de 100";
        $recarga->price=100;
        $recarga->commission=0;
        $recarga->iva=true;
        $recarga->final_price=100;
        $recarga->save();


        $recarga = new Recarga;
        $recarga->code="45343505";
        $recarga->category_id=3;
        $recarga->description="Recarga de 200";
        $recarga->price=200;
        $recarga->commission=0;
        $recarga->iva=true;
        $recarga->final_price=200;
        $recarga->save();

        $recarga = new Recarga;
        $recarga->code="45354w3545";
        $recarga->category_id=3;
        $recarga->description="Recarga de 500";
        $recarga->price=500;
        $recarga->commission=0;
        $recarga->iva=true;
        $recarga->final_price=500;
        $recarga->save();

        
    }
} 
