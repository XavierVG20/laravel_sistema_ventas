<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa_datos extends Model
{
    use HasFactory;

    protected $fillable =[
        'nombre_empresa',
        'email',
        'direccion',
        'telefono',
        'idmedia'
     
    ];
    public function media(){
        return $this->belongsTo('App\Models\Media');
    }
}
