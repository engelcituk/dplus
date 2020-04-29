<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes_servicios', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cliente_id')->unsigned(); 
            $table->bigInteger('servicio_id')->unsigned();            
            $table->string('referencia')->nullable();
            $table->string('antenna_ip')->nullable();
            $table->string('cliente_ip')->nullable();
            $table->string('antenna_password')->nullable();
            $table->string('router_password')->nullable();
            $table->timestamp('payment_date')->nullable();
            $table->timestamps();

            $table->foreign('cliente_id')->references('id')->on('clientes')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            
            $table->foreign('servicio_id')->references('id')->on('servicios')
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
        Schema::dropIfExists('clientes_servicios');
    }
}
