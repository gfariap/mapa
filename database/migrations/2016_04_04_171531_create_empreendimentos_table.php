<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpreendimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empreendimentos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('fachada');
            $table->integer('apartamentos_andar')->default(1);
            $table->integer('construido_em')->nullable();
            $table->boolean('marinha')->default(0);
            $table->string('lazer')->nullable();
            $table->text('observacoes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('empreendimentos');
    }
}
