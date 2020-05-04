<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClienteTelevisionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente_television', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cliente_id')->unsigned(); 
            $table->bigInteger('television_id')->unsigned();     
            $table->string('referencia')->nullable();
            $table->foreign('cliente_id')->references('id')->on('clientes')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            
            $table->foreign('television_id')->references('id')->on('televisions')
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
        Schema::dropIfExists('cliente_television');
    }
}
