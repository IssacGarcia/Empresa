<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Persona extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Persona', function (Blueprint $table)
		{
			$table->id();
			$table->string('nombre')->default('');
			$table->string('apellido_paterno')->default('');
			$table->string('apellido_materno')->default('');
			$table->string('email')->required()->unique();
			$table->string('password')->requiered();
			$table->string('telefono')->default('');
			$table->string('pais')->default('');
			$table->string('estado')->default('');
			$table->string('ciudad')->default('');
			$table->string('dirreccion')->default('');

			// Llaves foráneas
			$table->foreignId('id_rol')->nullable()->constrained('Rol');
			$table->foreignId('id_paquete')->nullable()->constrained('Paquete');
			$table->foreignId('id_contrato')->nullable()->constrained('Contrato');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Persona');
    }
}
