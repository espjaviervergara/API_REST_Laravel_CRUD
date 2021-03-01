<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    // $timestamps = false para que no traiga las fechas
    public $timestamps = false;
    protected $fillable = ['id', 'cat_nombre', 'cat_detalle'];//trae o asocia los campos de la base de datos
}
