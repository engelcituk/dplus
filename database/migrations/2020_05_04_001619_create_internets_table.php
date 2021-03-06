<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('days_periods_id')->unsigned();
            $table->string('description')->nullable();
            $table->decimal('price');
            $table->decimal('assurance');
            $table->decimal('final_price');
            $table->boolean('iva');
            $table->timestamps();    
            $table->foreign('category_id')->references('id')->on('categories')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');        
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
        Schema::dropIfExists('internets');
    }
}
