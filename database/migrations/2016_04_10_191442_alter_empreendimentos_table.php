<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterEmpreendimentosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empreendimentos', function (Blueprint $table) {
            $table->string('latitude');
            $table->string('longitude');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('empreendimentos', function (Blueprint $table) {
            $table->dropColumn([ 'latitude', 'longitude' ]);
        });
    }
}
