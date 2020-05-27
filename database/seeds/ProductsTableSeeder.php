<?php

use Illuminate\Database\Seeder;
use App\Producto;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Producto::truncate();// limpio la tabla

        $product = new Producto;
        $product->category_id=4;
        $product->barcode="1273298573952";
        $product->description="producto 1";
        $product->price_cost=45;
        $product->sale_price=50;
        $product->wholesale_price=60;
        $product->has_inventory=true;
        $product->units=25;
        $product->minimum=5;
        $product->save();

        $product = new Producto;
        $product->category_id=4;
        $product->barcode="2473298573952";
        $product->description="producto 2";
        $product->price_cost=15;
        $product->sale_price=20;
        $product->wholesale_price=25;
        $product->has_inventory=true;
        $product->units=25;
        $product->minimum=5;
        $product->save();

        $product = new Producto;
        $product->category_id=4;
        $product->barcode="4573298573952";
        $product->description="producto 3";
        $product->price_cost=20;
        $product->sale_price=30;
        $product->wholesale_price=40;
        $product->has_inventory=true;
        $product->units=25;
        $product->minimum=5;
        $product->save();
    }
}
