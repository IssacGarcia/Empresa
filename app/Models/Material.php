<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;
	public $timestamps = false;
	protected $table = 'Material';

	protected $fillable =
	[
		'modelo',
		'descripcion',
		'id_trabajo'
	];
}