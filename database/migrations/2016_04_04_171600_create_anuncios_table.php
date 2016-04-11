<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnunciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anuncios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo');
            $table->decimal('valor', 12, 2);
            $table->string('finalidade');
            $table->integer('quartos')->nullable();
            $table->integer('suites')->nullable();
            $table->integer('garagem')->nullable();
            $table->text('observacoes')->nullable();
            $table->integer('coluna_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('coluna_id')->references('id')->on('colunas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('anuncios');
    }
}
