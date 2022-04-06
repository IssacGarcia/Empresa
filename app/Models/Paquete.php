<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paquete extends Model
{
    use HasFactory;
	public $timestamps = false;
	protected $table = 'Paquete';

	protected $fillable =
	[
		'nombre',
		'descripcion',
		'precio'
	];
}