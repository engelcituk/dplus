<?php

use Illuminate\Database\Seeder;
use App\Printer;

class PrintersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Printer::truncate();// limpio la tabla

        $printer = new Printer;
        $printer->name="Ec line principal";
        $printer->shared_name="Ec-line";
        $printer->ip="127.0.0.1";
        $printer->available=true;
        $printer->default=true;
        $printer->use_mode='compartido';
        $printer->save();

        $printer = new Printer;
        $printer->name="Ec line secundario";
        $printer->shared_name="Ec-line2";
        $printer->ip="127.0.0.2";
        $printer->available=true;
        $printer->default=false;
        $printer->use_mode='compartido';
        $printer->save();

        $printer = new Printer;
        $printer->name="Ec line respaldo";
        $printer->shared_name="Ec-line3";
        $printer->ip="127.0.0.3";
        $printer->available=true;
        $printer->default=false;
        $printer->use_mode='ip';
        $printer->save();
    }
}
