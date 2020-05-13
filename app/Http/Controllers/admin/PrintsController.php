<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//para usar impresoras por nombre compartido
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\CapabilityProfile;

class PrintsController extends Controller
{
    public function sharedPrinterTest(Request $request){

        $nombreCompartido = $request->get('nombreCompartido');

        $profile = CapabilityProfile::load("simple");
        $smb='smb://CEO-DP/';
        $connector = new WindowsPrintConnector($nombreCompartido);

        $impresora = new Printer($connector, $profile);
        
        try {
           
            $impresora->text("Hola mundo ticket\n");
            $impresora->text("Hola mundo ticket 2\n");
            $impresora->text("-----------------------\n");
            $impresora->text("\n");
            $impresora->cut();
        } finally {
            $impresora->close();
        }
    }

    public function ipPrinterTest(Request $request){

        $ip = $request->get('ip');

        return $ip;
    }
}
