<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;
	public $timestamps = false;
	protected $table = 'Pago';

	protected $fillable =
	[
		'fecha',
		'cantidad',
		'id_persona'
	];
}