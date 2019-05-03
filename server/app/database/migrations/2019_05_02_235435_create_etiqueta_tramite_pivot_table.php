<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEtiquetaTramitePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etiqueta_tramite', function (Blueprint $table) {
            $table->unsignedBigInteger('etiqueta_id')->index();
            $table->unsignedBigInteger('tramite_id')->index();
            $table->foreign('etiqueta_id')->references('id')->on('etiquetas')->onDelete('cascade');
            $table->foreign('tramite_id')->references('id')->on('tramites')->onDelete('cascade');
            $table->primary(['etiqueta_id', 'tramite_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('etiqueta_tramite');
    }
}
