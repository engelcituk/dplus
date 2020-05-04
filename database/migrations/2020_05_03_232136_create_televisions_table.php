<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelevisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('televisions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('days_periods_id')->unsigned();
            $table->string('description')->nullable();
            $table->decimal('price');
            $table->decimal('commission');
            $table->decimal('final_price');
            $table->timestamps();
            $table->foreign('days_periods_id')->references('id')->on('days_periods')
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
        Schema::dropIfExists('televisions');
    }
}
