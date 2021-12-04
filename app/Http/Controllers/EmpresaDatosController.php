<?php

namespace App\Http\Controllers;

use App\Models\Empresa_datos;
use App\Models\Media;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\EmpresaDatosRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Cloudinary;


class EmpresaDatosController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function  index(Request $request){
        if (!$request->ajax())   return view('empresa_datos');
       
       return  $empresa_datos = Empresa_datos::leftjoin('media', 'empresa_datos.idmedia', '=', 'media.id' )
       ->get();
       
    }
  

    public function  info()
    {
        # code...
        return  $empresa_datos = Empresa_datos::join('media', 'empresa_datos.idmedia', '=', 'media.id' )
        ->get();
        
        
    }

     public function store(EmpresaDatosRequest $request)
    {
      
        
        
         
    if ($request->hasFile('avatar')) {
             
             $result = $request->avatar->storeOnCloudinary('logo');
 
             $media = new Media();
            // $media->idmedia = $request->id;
             $media->public_id = $result->getPublicId();
             $media->file_url =  $result->getSecurePath();
             $media->file_name = $result->getFileName();
             $media->file_type = $result->getFileType();
             $media->size = $result->getSize();
                        
             $media->save();

              
         $empresa_datos= new Empresa_datos();
         $empresa_datos ->nombre_empresa = $request->nombre_empresa;
         $empresa_datos -> email = $request-> email;
         $empresa_datos -> direccion = $request-> direccion ; 
         $empresa_datos ->  telefono = $request-> telefono;
         $empresa_datos -> idmedia = $media->id;
         $empresa_datos->save();
 
  
         }
         else{
            $empresa_datos= new Empresa_datos();
         
            $empresa_datos ->nombre_empresa = $request->nombre_empresa;
            $empresa_datos -> email = $request-> email;
            $empresa_datos -> direccion = $request-> direccion ; 
            $empresa_datos ->  telefono = $request-> telefono;

            $empresa_datos->save();

           

         }
         

    }
     public function update(EmpresaDatosRequest $request)
    {
     //   DB::beginTransaction();

//try {
  
         

    if ($request->hasFile('avatar')) {
       
            Cloudinary::destroy($request->public_id);
     
   
        $result = $request->avatar->storeOnCloudinary('logo');
 
        $media = new Media();
       // $media->idmedia = $request->id;
        $media->public_id = $result->getPublicId();
        $media->file_url =  $result->getSecurePath();
        $media->file_name = $result->getFileName();
        $media->file_type = $result->getFileType();
        $media->size = $result->getSize();
                   
        $media->save();

             $empresa_datos= Empresa_datos::findOrFail($request->id);
         
             $empresa_datos ->nombre_empresa = $request->nombre_empresa;
             $empresa_datos -> email = $request-> email;
             $empresa_datos -> direccion = $request-> direccion ; 
             $empresa_datos ->  telefono = $request-> telefono;
             $empresa_datos -> idmedia = $media->id;
             $empresa_datos->save();
 
     return   $empresa_datos;    
         }
         else{
            $empresa_datos= Empresa_datos::findOrFail($request->id);
         
            $empresa_datos ->nombre_empresa = $request->nombre_empresa;
            $empresa_datos -> email = $request-> email;
            $empresa_datos -> direccion = $request-> direccion ; 
            $empresa_datos ->  telefono = $request-> telefono;
            $empresa_datos->save();

            

         }
//} catch (\Throwable $e) {
 //   DB::rollback();
 //   throw $e;
//}

         
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
