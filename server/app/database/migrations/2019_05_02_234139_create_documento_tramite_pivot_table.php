<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentoTramitePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documento_tramite', function (Blueprint $table) {
            $table->unsignedBigInteger('documento_id')->index();
            $table->unsignedBigInteger('tramite_id')->index();
            $table->foreign('documento_id')->references('id')->on('documentos')->onDelete('cascade');
            $table->foreign('tramite_id')->references('id')->on('tramites')->onDelete('cascade');
            $table->primary(['documento_id', 'tramite_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('documento_tramite');
    }
}
