<?php

namespace App\Http\Controllers;

use App\Models\Empresa_datos;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class EmpresaDatosController extends Controller
{
    //
    public function  index(Request $request){
       // if (!$request->ajax())   return view('empresa_datos');
       
        return  $empresa_datos = Empresa_datos::get();

    }

    public function  info()
    {
        # code...
        
        
    }

     public function store(Request $request)
    {
        # code...

        if ($request->hasFile('avatar')) {

            $file_data = $request->avatar;
            $img = Storage::putFile('public/images',$file_data);
            $empresa_datos = new Empresa_datos();
         
            $empresa_datos ->nombre_empresa = $request->nombre_empresa;
             $empresa_datos -> email = $request-> email;
             $empresa_datos -> direccion = $request-> direccion ; 
             $empresa_datos ->  telefono = $request-> telefono;
             $empresa_datos -> image = $img; 

             $empresa_datos->save();
             //$userAvatarUpdate = User::find(Auth::user()->id);
            //$userAvatarUpdate->avatar = $avatar; {{url(‘storage/’.$post->image)}}
            //$userAvatarUpdate->update();
            
            return  $img ;
    
    
        }
        return "Noo Llego una imagen";
         

    }
     public function update(Request $request)
    {

            
        # code...
        if ($request->hasFile('avatar')) {

            $file_data = $request->avatar;
            $img = Storage::putFile('public/images',$file_data);
            $empresa_datos= Empresa_datos::findOrFail($request->id);
         
            $empresa_datos ->nombre_empresa = $request->nombre_empresa;
             $empresa_datos -> email = $request-> email;
             $empresa_datos -> direccion = $request-> direccion ; 
             $empresa_datos ->  telefono = $request-> telefono;
             $empresa_datos -> image = $img;

            $empresa_datos->save();
             //$userAvatarUpdate = User::find(Auth::user()->id);
            //$userAvatarUpdate->avatar = $avatar; {{url(‘storage/’.$post->image)}}
            //$userAvatarUpdate->update();
            return  $request ;
    
    
        }
        return "Noo Llego una imagen";
         
     
    }

     public function Upload_img(Request $request)
     {
         # code...
          // Verificamos si hay un file con nombre avatar
    if ($request->hasFile('avatar')) {

        $file_data = $request->avatar;
        $img = Storage::putFile('public/img',$file_data);
        $empresa_datos= Empresa_datos::findOrFail($request->id);
     
        $empresa_datos ->nombre_empresa = $request->nombre_empresa;
         $empresa_datos -> email = $request-> email;
         $empresa_datos -> direccion = $request-> direccion ; 
         $empresa_datos ->  telefono = $request-> telefono;
        $empresa_datos->save();
         //$userAvatarUpdate = User::find(Auth::user()->id);
        //$userAvatarUpdate->avatar = $avatar;
        //$userAvatarUpdate->update();
        return  $request ;


    }
    return "Noo Llego una imagen";
     }
}
