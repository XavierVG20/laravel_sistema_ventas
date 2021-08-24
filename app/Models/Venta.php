<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    public $timestamps = false;

    protected $fillable =[
        'idcliente', 
        'idusuario',
        'tipo_comprobante',
        'serie_comprobante',
        'num_comprobante',
        'fecha_hora',
        'impuesto',
        'total',
        'estado'
    ];
    public function usuario()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function cliente()
    {
        return $this->belongsTo('App\Models\Persona');
    }
 
}
