<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;
	public $timestamps = false;
	protected $table = 'Contrato';

	protected $fillable =
	[
		'fecha_inicio',
		'fecha_corte'
	];
}