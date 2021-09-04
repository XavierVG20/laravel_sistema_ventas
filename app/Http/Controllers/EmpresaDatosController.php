<?php

namespace App\Http\Controllers;

use App\Models\Empresa_datos;

use Illuminate\Http\Request;


class EmpresaDatosController extends Controller
{
    //
    public function  index(Request $request){
        if (!$request->ajax())   return view('empresa_datos');
        $empresa_datos = Empresa_datos::all();
        return [
            'datos' => $empresa_datos
        ] ;
    }

    public function  info()
    {
        # code...
        
        
    }

     public function store(Request $request)
    {
        # code...

        $empresa_datos = new Empresa_datos();
        $empresa_datos ->nombre_empresa = $request->nombre_empresa;
        $empresa_datos -> email = $request-> email;
        $empresa_datos -> direccio = $request-> direccion ; 
        $empresa_datos ->  telefono = $request-> telefono;
        $empresa_datos->save();

    }
     public function update(Request $request)
    {
        # code...
        $empresa_datos= Empresa_datos::findOrFail($request->id);
        $empresa_datos ->nombre_empresa = $request->nombre_empresa;
        $empresa_datos -> email = $request-> email;
        $empresa_datos -> direccio = $request-> direccion ; 
        $empresa_datos ->  telefono = $request-> telefono;
        $empresa_datos->save();
    }
}
