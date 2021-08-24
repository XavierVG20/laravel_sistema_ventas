<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
 
use App\Models\Proveedor;


class ProveedorController extends Controller
{
    //
    public function index(Request $request)
    {
      if (!$request->ajax()) return view('proveedor');
 
        $buscar = $request->buscar;
        $criterio = $request->criterio;
         
        if ($buscar==''){
            $personas = Proveedor::orderBy('id', 'desc')->paginate(3);
        }
        else{
            $personas = Proveedor::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(3);
        }
         
 
        return [
            'pagination' => [
                'total'        => $personas->total(),
                'current_page' => $personas->currentPage(),
                'per_page'     => $personas->perPage(),
                'last_page'    => $personas->lastPage(),
                'from'         => $personas->firstItem(),
                'to'           => $personas->lastItem(),
            ],
            'personas' => $personas
        ];
    }
 
    public function selectProveedor(Request $request){
        if (!$request->ajax()) return redirect('/');
 
        $filtro = $request->filtro;
        $proveedores = Proveedor::where('nombre', 'like', '%'. $filtro . '%')
        ->orWhere('num_documento', 'like', '%'. $filtro . '%')
        ->select('id','nombre','num_documento')
        ->orderBy('nombre', 'asc')->get();
 
        return ['proveedores' => $proveedores];
    }
 
    public function store(Request $request)
    {         
 
        DB::insert('insert into categorias ( nombre) values ( ?)', [ 'Marc']);

        try{
            DB::beginTransaction();
            $proveedor = new Proveedor();
            $proveedor->contacto = $request->contacto;
            $proveedor->telefono_contacto = $request->telefono_contacto;
            $proveedor->nombre = $request->nombre;
            $proveedor->tipo_documento = $request->tipo_documento;
            $proveedor->num_documento = $request->num_documento;
            $proveedor->direccion = $request->direccion;
            $proveedor->telefono = $request->telefono;
            $proveedor->email = $request->email;
 
           
            $proveedor->save();
 
            DB::commit();
 
        } catch (Exception $e){
            DB::rollBack();
        }
 

         
         
    }
 
    public function update(Request $request , Proveedor $proveedor)
    {
        if (!$request->ajax()) return redirect('/');
         
        try{
 
            //Buscar primero el proveedor a modificar
            $proveedor = Proveedor::findOrFail($request->id);
 
          
 
 
            $proveedor->update($request->all()); 
        } catch (Exception $e){
            DB::rollBack();
        }
 
    }
}
