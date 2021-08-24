<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedores';
    protected $fillable = [
    'contacto',
    'telefono_contacto',
    'nombre',
    'tipo_documento',
    'num_documento',
    'direccion',
    'telefono',
    'email'];
    public function user()
    {
        return $this->hasOne('App\Models\User');
    }


 

    
}
