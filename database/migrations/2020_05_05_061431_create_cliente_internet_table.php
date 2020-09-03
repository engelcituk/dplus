<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClienteInternetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente_internet', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cliente_id')->unsigned(); 
            $table->bigInteger('internet_id')->unsigned();     
            $table->string('antenna_ip')->nullable();
            $table->string('client_ip')->nullable();
            $table->string('antenna_password')->nullable();
            $table->string('router_password')->nullable();
            $table->timestamp('date_start')->nullable();
            $table->timestamp('date_expiration')->nullable();
            $table->foreign('cliente_id')->references('id')->on('clientes')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            
            $table->foreign('internet_id')->references('id')->on('internets')
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
        Schema::dropIfExists('cliente_internet');
    }
}
