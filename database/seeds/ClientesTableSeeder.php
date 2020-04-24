<?php

use Illuminate\Database\Seeder;
use App\Cliente;

class ClientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cliente::truncate();// limpio la tabla

        $cliente = new Cliente;
        $cliente->name="Fabiana Baak Chan";
        $cliente->save();

        $cliente = new Cliente;
        $cliente->name="Alex Eliaster Pool Chan";
        $cliente->save();

        $cliente = new Cliente;
        $cliente->name="Pablo Noh Dzul";
        $cliente->save();

        $cliente = new Cliente;
        $cliente->name="Anselma Estrada Dzul";
        $cliente->save();

        $cliente = new Cliente;
        $cliente->name="Marcos Canté Canul";
        $cliente->save();

        $cliente = new Cliente;
        $cliente->name="Geronima Caamal Cituk";
        $cliente->save();

        $cliente = new Cliente;
        $cliente->name="Carlos Yama";
        $cliente->save();

        $cliente = new Cliente;
        $cliente->name="Hilaria Yama Ek";
        $cliente->save();

        $cliente = new Cliente;
        $cliente->name="Humberta Chan Dzul";
        $cliente->save();

        $cliente = new Cliente;
        $cliente->name="Ermilo Caamal Chan";
        $cliente->save();

    
    }
}
