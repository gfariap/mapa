<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fotos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo')->nullable();
            $table->string('caminho');
            $table->text('descricao')->nullable();
            $table->integer('related_id')->unsigned()->nullable();
            $table->string('related_type')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['related_id', 'related_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('fotos');
    }
}
