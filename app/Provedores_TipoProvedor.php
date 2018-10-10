<?php

namespace CEPROZAC;

use Illuminate\Database\Eloquent\Model;

class Provedores_TipoProvedor extends Model
{
	protected $table= "provedores_tipo_provedor";

	
	protected $fillable = ['idProvedorMaterial', 'idTipoProvedor'];



}

