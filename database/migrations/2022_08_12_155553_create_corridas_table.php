<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorridasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corridas', function (Blueprint $table) {
            $table->id();
            $table->integer('idUser');
            $table->integer('IdDriver');
            $table->integer('valor');
            $table->string('status');
            $table->string('pagamento');
            $table->string('pagamento_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('corridas');
    }
}
