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
            $table->float('valor', $total = 5,  $places = 2);
            $table->string('status')->default("em andamento")->nullable($value = true);
            $table->string('pagamento');
            $table->string('pagamento_status')->default("pendente")->nullable($value = true);
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
