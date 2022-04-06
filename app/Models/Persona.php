<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Persona extends Authenticatable implements JWTSubject
{
    use HasFactory;
	public $timestamps = false;
	protected $table = 'Persona';

	protected $fillable =
	[
		'nombre',
		'apellido_paterno',
		'apellido_materno',
		'email',
		'password',
		'telefono',
		'pais',
		'estado',
		'ciudad',
		'dirreccion',
		'id_rol',
		'id_paquete',
		'id_contrato'
	];

	protected $hidden =
	[
		'password'
	];

	public function getJWTIdentifier() { return $this->getKey(); }
	public function getJWTCustomClaims() { return []; }
}