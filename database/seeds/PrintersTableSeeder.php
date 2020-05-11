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
        $printer->name="Ec_line";
        $printer->ip="127.0.0.1";
        $printer->save();

        $printer = new Printer;
        $printer->name="Ec_line";
        $printer->ip="127.0.0.1";
        $printer->save();

        $printer = new Printer;
        $printer->name="Ec_line";
        $printer->ip="127.0.0.1";
        $printer->save();
    }
}
