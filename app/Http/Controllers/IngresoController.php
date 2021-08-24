<?php

namespace App\Http\Controllers;
use App\Models\Ingreso;
use Carbon\Carbon;
use App\Models\DetalleIngreso;
use App\Models\User;
use Illuminate\Http\Request;

class IngresoController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return view('ingreso');
 
        $buscar = $request->buscar;
        $criterio = $request->criterio;
         
        if ($buscar==''){
            $ingresos = Ingreso::join('users','ingresos.idusuario','=','users.id')
            ->join('proveedores','ingresos.idproveedor','=','proveedores.id')
            ->select('ingresos.id','ingresos.tipo_comprobante','ingresos.serie_comprobante',
            'ingresos.num_comprobante','ingresos.fecha_hora','ingresos.impuesto','ingresos.total',
            'ingresos.estado', 'users.name', 'proveedores.nombre')
            ->orderBy('ingresos.id', 'desc')->paginate(3);
        }
        else{
            $ingresos = Ingreso::join('users','ingresos.idusuario','=','users.id')
            ->join('proveedores','ingresos.idproveedor','=','proveedores.id')
            ->select('ingresos.id','ingresos.tipo_comprobante','ingresos.serie_comprobante',
            'ingresos.num_comprobante','ingresos.fecha_hora','ingresos.impuesto','ingresos.total',
            'ingresos.estado', 'users.name', 'proveedores.nombre')
            ->where('ingresos.'.$criterio, 'like', '%'. $buscar . '%')->orderBy('ingresos.id', 'desc')->paginate(3);
        }
         
        return [
            'pagination' => [
                'total'        => $ingresos->total(),
                'current_page' => $ingresos->currentPage(),
                'per_page'     => $ingresos->perPage(),
                'last_page'    => $ingresos->lastPage(),
                'from'         => $ingresos->firstItem(),
                'to'           => $ingresos->lastItem(),
            ],
            'ingresos' => $ingresos
        ];
    }
    public function obtenerCabecera(Request $request){
        if (!$request->ajax()) return redirect('/');
 
        $id = $request->id;
         

        $ingreso = Ingreso::join('proveedores','ingresos.idproveedor','=','proveedores.id')
        ->join('users','ingresos.idusuario','=','users.id')
        ->select('ingresos.id','ingresos.tipo_comprobante','ingresos.serie_comprobante',
        'ingresos.num_comprobante','ingresos.fecha_hora','ingresos.impuesto','ingresos.total',
        'ingresos.estado','proveedores.nombre','users.name')
        ->where('ingresos.id','=',$id)
        ->orderBy('ingresos.id', 'desc')->take(1)->get();

         
        return [
           
            'ingreso' => $ingreso
        ];
    }
    public function obtenerDetalles(Request $request){
        if (!$request->ajax()) return redirect('/');
 
        $id = $request->id;
         
        $detalles = DetalleIngreso::join('articulos','detalle_ingresos.idarticulo','=','articulos.id')
        ->select('detalle_ingresos.cantidad','detalle_ingresos.precio','articulos.nombre as articulo')
        ->where('detalle_ingresos.idingreso','=',$id)
        ->orderBy('detalle_ingresos.id', 'desc')->get();

         
        return [
           
            'detalles' => $detalles
        ];
    }
    public function store(Request $request)
    {
 
       // try{
        //  DB::beginTransaction();
          $mytime = Carbon::now();
           
          $ingreso = new Ingreso();
            $ingreso->idproveedor = $request->idproveedor;
         $ingreso->idusuario = \Auth::user()->id;
          $ingreso->tipo_comprobante = $request->tipo_comprobante;
            $ingreso->serie_comprobante = $request->serie_comprobante;
            $ingreso->num_comprobante = $request->num_comprobante;
         $ingreso->fecha_hora = $mytime->toDateString();
          $ingreso->impuesto = $request->impuesto;
          $ingreso->total = $request->total;
        $ingreso->estado = 'Registrado';
            $ingreso->save();
 
            $detalles = $request->data;//Array de detalles
            //Recorro todos los elementos

        foreach($detalles as $ep=>$det)
            {
               $detalle = new DetalleIngreso();
                $detalle->idingreso = $ingreso->id;
                $detalle->idarticulo = $det['idarticulo'];
                $detalle->cantidad = $det['cantidad'];
                $detalle->precio = $det['precio'];          
                $detalle->save();
            }          
      
     //   } catch (Exception $e){
           // DB::rollBack();
///} 
        return [
           
            'ingreso' => $ingreso->id
        ];
    }
 
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $ingreso = Ingreso::findOrFail($request->id);
        $ingreso->estado = 'Anulado';
        $ingreso->save();
    }
}
