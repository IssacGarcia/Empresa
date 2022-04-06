<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Equipo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Equipo', function (Blueprint $table)
		{
			$table->id();
			$table->string('modelo');
			$table->string('descripcion');

			// Llaves foráneas
			$table->foreignId('id_persona')->nullable()->constrained('Persona');
			$table->foreignId('id_trabajo')->nullable()->constrained('Trabajo');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Equipo');
    }
}
