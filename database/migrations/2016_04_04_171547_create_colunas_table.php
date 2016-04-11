<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColunasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colunas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo');
            $table->string('planta');
            $table->decimal('area', 8, 2);
            $table->integer('quartos')->default(1);
            $table->integer('suites')->default(0);
            $table->integer('garagem')->default(1);
            $table->text('observacoes')->nullable();
            $table->integer('empreendimento_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('empreendimento_id')->references('id')->on('empreendimentos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('colunas');
    }
}
