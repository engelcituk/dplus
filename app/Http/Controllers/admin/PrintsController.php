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
    // la impresora está conectado por usb, pero tiene que ser compartida desde windows
    public function sharedPrinterTest(Request $request){

        $nombreImpresoraUsb = 'xprinter-pos';
        
        try {
            // Enter the share name for your USB printer here
            //$connector = null;
            $connector = new WindowsPrintConnector($nombreImpresoraUsb);
            /* Print a "Hello world" receipt" */
            // conv("UTF-8", "ASCII", "$text"), PHP_EOL;
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
