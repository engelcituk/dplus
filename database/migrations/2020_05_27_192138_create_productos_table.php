<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->bigInteger('category_id')->unsigned();
            $table->string('description');
            $table->decimal('price_cost');
            $table->decimal('sale_price');
            $table->decimal('wholesale_price');
            $table->boolean('has_inventory');
            $table->boolean('iva');
            $table->integer('units');
            $table->integer('minimum');

            $table->foreign('category_id')->references('id')->on('categories')
                    ->onDelete('cascade')
                    ->onUpdate('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
