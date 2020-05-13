<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//para usar impresoras por nombre compartido
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\CapabilityProfile;

use Mike42\Escpos\Printer;


class PrintsController extends Controller
{
    public function sharedPrinterTest(Request $request){

        // $nombreCompartido = $request->get('nombreCompartido');

        // $profile = CapabilityProfile::load("simple");
        // $smb='smb://CEO-DP/';
        // $connector = new WindowsPrintConnector($nombreCompartido);

        // $impresora = new Printer($connector, $profile);
        
        // try {
           
        //     $impresora->text("Hola mundo ticket\n");
        //     $impresora->text("Hola mundo ticket 2\n");
        //     $impresora->text("-----------------------\n");
        //     $impresora->text("\n");
        //     $impresora->cut();
        // } finally {
        //     $impresora->close();
        // }
        $nombreImpresoraUsb = 'Printer-Pos';
        
        try {
            // Enter the share name for your USB printer here
            //$connector = null;
            $connector = new WindowsPrintConnector($nombreImpresoraUsb);
            /* Print a "Hello world" receipt" */
            $printer = new Printer($connector);
            $printer -> text("Hello World!\n");
            $printer -> text("Prueba de impresión!\n");
            $printer -> text("Impresora usb!\n");
            $printer -> text("Prueba desde desarrollo!\n");
            $printer -> text("Desde PC de desarrollo!\n");
            $printer -> text(" :) wiii\n");
            $printer->text("\n");
            $printer->text("\n");
            $printer->text("\n");
            $printer -> cut();
            
            /* Close printer */
            $printer -> close();
        } catch (Exception $e) {
            echo "No se puede imprimir con esta impresora: " . $e -> getMessage() . "\n";
        }
    }
    public function ipPrinterTest(Request $request){

        $ip = $request->get('ip');

        return $ip;
    }

    public function usbPrinterTest(Request $request){
        
        $nombreImpresoraUsb = $request->get('nombreImpresoraUsb');
        
        try {
            // Enter the share name for your USB printer here
            //$connector = null;
            $connector = new WindowsPrintConnector($nombreImpresoraUsb);
            /* Print a "Hello world" receipt" */
            $printer = new Printer($connector);
            $printer -> text("Hello World!\n");
            $printer -> cut();
            
            /* Close printer */
            $printer -> close();
        } catch (Exception $e) {
            echo "No se puede imprimir con esta impresora: " . $e -> getMessage() . "\n";
        }
    }
}
