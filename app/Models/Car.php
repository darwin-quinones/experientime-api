<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Car extends Model {

    protected $table = 'cars';
    protected $primarykey = 'id';
    public $timestamps = false;
}


// <?php
// namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
// class ArchivosCargadosCatastro extends Model
// {
//   protected $table = 'archivos_cargados_catastro_2';
//   protected $primaryKey = 'ID_TABLA';
//   public $timestamps = false;
// }
