<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;
use DataTables;


class ArticuloController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return view('articulo');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
      
        if ($buscar==''){
            $articulos = Articulo::join('categorias','articulos.idcategoria','=','categorias.id')
            ->select('articulos.id','articulos.idcategoria','articulos.codigo','articulos.nombre','categorias.nombre as nombre_categoria','articulos.precio_venta','articulos.stock','articulos.descripcion','articulos.condicion')
            ->orderBy('articulos.id', 'desc')->paginate(5);
        }
        else{
            $articulos = Articulo::join('categorias','articulos.idcategoria','=','categorias.id')
            ->select('articulos.id','articulos.idcategoria','articulos.codigo','articulos.nombre','categorias.nombre as nombre_categoria','articulos.precio_venta','articulos.stock','articulos.descripcion','articulos.condicion')
            ->where('articulos.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('articulos.id', 'desc')->paginate(5);
        }
        

        return [
            'pagination' => [
                'total'        => $articulos->total(),
                'current_page' => $articulos->currentPage(),
                'per_page'     => $articulos->perPage(),
                'last_page'    => $articulos->lastPage(),
                'from'         => $articulos->firstItem(),
                'to'           => $articulos->lastItem(),
            ],
            'articulos' => $articulos
        ];
    }
    public function listarArticulo(Request $request)
    {
       

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $articulos = Articulo::join('categorias','articulos.idcategoria','=','categorias.id')
            ->select('articulos.id','articulos.idcategoria','articulos.codigo','articulos.nombre','categorias.nombre as nombre_categoria','articulos.precio_venta','articulos.stock','articulos.descripcion','articulos.condicion')
            ->orderBy('articulos.id', 'desc')->paginate(10);
        }
        else{
            $articulos = Articulo::join('categorias','articulos.idcategoria','=','categorias.id')
            ->select('articulos.id','articulos.idcategoria','articulos.codigo','articulos.nombre','categorias.nombre as nombre_categoria','articulos.precio_venta','articulos.stock','articulos.descripcion','articulos.condicion')
            ->where('articulos.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('articulos.id', 'desc')->paginate(10);
        }
        

        return ['articulos' => $articulos];
    }
    public function listarArticuloVenta(Request $request)
    {
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $articulos = Articulo::join('categorias','articulos.idcategoria','=','categorias.id')
            ->select('articulos.id','articulos.idcategoria','articulos.codigo','articulos.nombre','categorias.nombre as nombre_categoria','articulos.precio_venta','articulos.stock','articulos.descripcion','articulos.condicion')
            ->where('articulos.stock','>','0')
            ->orderBy('articulos.id', 'desc')->paginate(10);
        }
        else{
            $articulos = Articulo::join('categorias','articulos.idcategoria','=','categorias.id')
            ->select('articulos.id','articulos.idcategoria','articulos.codigo','articulos.nombre','categorias.nombre as nombre_categoria','articulos.precio_venta','articulos.stock','articulos.descripcion','articulos.condicion')
            ->where('articulos.'.$criterio, 'like', '%'. $buscar . '%')
            ->where('articulos.stock','>','0')
            ->orderBy('articulos.id', 'desc')->paginate(10);
        }
        

        return ['articulos' => $articulos];
    }
    public function listarPdf(){

        $articulos = Articulo::join('categorias','articulos.idcategoria','=','categorias.id')
        ->select('articulos.id','articulos.idcategoria','articulos.codigo','articulos.nombre','categorias.nombre as nombre_categoria','articulos.precio_venta','articulos.stock','articulos.descripcion','articulos.condicion')
        ->orderBy('articulos.nombre', 'desc')->get();

        $cont=Articulo::count();

        $pdf = \PDF::loadView('pdf.articulospdf',['articulos'=>$articulos,'cont'=>$cont]);
        return $pdf->download('articulos.pdf');
    }
    public function buscarArticulo(Request $request ){

        $filtro = $request->filtro;
        if($filtro){
            $articulos = Articulo::where('codigo','=', $filtro)
            ->select('id', 'nombre')->orderBy('nombre', 'asc')->take(1)->get();
        }else{
            $articulos = Articulo::orderBy('nombre', 'asc');
    
        }
        
        return ['articulos' => $articulos];
    }
    public function buscarArticuloVenta(Request $request ){

        $filtro = $request->filtro;
        $articulos = Articulo::where('codigo','=', $filtro)
        ->select('id', 'nombre','stock','precio_venta')
        ->where('stock','>','0')
        ->orderBy('nombre', 'asc')->take(1)->get();

        return ['articulos' => $articulos];
    }
    public function store(Request $request)
    {
        $request->validate([
            'idcategoria'=> 'required',
            'nombre'=>'required',
            'precio_venta'=>'numeric|min:1',
            'stock'=>'numeric|min:1',
            'codigo'=>'required|numeric',
            'descripcion'=>'min:4',

           
        ]);
         $articulo = new Articulo();
        $articulo->idcategoria = $request->idcategoria;
        $articulo->codigo = $request->codigo;
        $articulo->nombre = $request->nombre;
        $articulo->precio_venta = $request->precio_venta;
        $articulo->stock = $request->stock;
        $articulo->descripcion = $request->descripcion;
        $articulo->condicion = '1';
        $articulo->save();
    }
    public function update(Request $request)
    {
        $request->validate([
            'idcategoria'=> 'required',
            'nombre'=>'required',
            'precio_venta'=>'numeric|min:1',
            'stock'=>'numeric|min:1',
            'codigo'=>'required|numeric',
            'descripcion'=>'min:4',
           
        ]);
                $articulo = Articulo::findOrFail($request->id);
        $articulo->idcategoria = $request->idcategoria;
        $articulo->codigo = $request->codigo;
        $articulo->nombre = $request->nombre;
        $articulo->precio_venta = $request->precio_venta;
        $articulo->stock = $request->stock;
        $articulo->descripcion = $request->descripcion;
        $articulo->condicion = '1';
        $articulo->save();
    }

    public function desactivar(Request $request)
    {
        $articulo = Articulo::findOrFail($request->id);
        $articulo->condicion = '0';
        $articulo->save();
    }

    public function activar(Request $request)
    {
        $articulo = Articulo::findOrFail($request->id);
        $articulo->condicion = '1';
        $articulo->save();
    }
    public function destroy(Request $request)
    {
        $articulo = Articulo::findOrFail($request->id);
     
        $articulo->delete();
    }
}
