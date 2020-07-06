<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('folio');
            $table->string('code');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('cliente_id')->nullable()->unsigned();
            $table->morphs('transactionable');
            $table->string('description');
            $table->string('name_cliente')->nullable();
            $table->string('reference')->nullable();
            $table->integer('quantity');//cantidad
            $table->decimal('price'); // precio
            $table->decimal('commission');
            $table->string('provider_payment_number')->nullable();// numero de pago proveedor
            $table->string('provider_authorization_number')->nullable();//numero de autorizacion
            $table->string('note');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
                    ->onDelete('cascade')
                    ->onUpdate('cascade'); 

            $table->foreign('cliente_id')->references('id')->on('clientes')
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
        Schema::dropIfExists('transactions');
    }
}
