<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pago extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Pago', function (Blueprint $table)
		{
			$table->id();
			$table->date('fecha');
			$table->integer('cantidad');

			// Llaves foráneas
			$table->foreignId('id_persona')->nullable()->constrained('Persona');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Pago');
    }
}
