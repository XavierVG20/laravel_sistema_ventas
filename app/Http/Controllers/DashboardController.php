<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Ingreso;


class DashboardController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $reques){
      //   return view('home');
      $anio=date('Y');


      $ingresos=DB::table('ingresos')
      ->select(
      DB::raw('YEAR(fecha_hora) as anio'),
      DB::raw('SUM(total) as total'),
      DB::raw('count(*) as total_ingresos'))
      ->whereYear('fecha_hora',$anio)
      ->groupBy(DB::raw('YEAR(fecha_hora)'))
      ->get();

      $ventas=DB::table('ventas as v')
      ->select(
      DB::raw('YEAR(v.fecha_hora) as anio'),
      DB::raw('SUM(v.total) as total'),
      DB::raw('count(*) as total_ventas'))
      ->whereYear('v.fecha_hora',$anio)
      ->groupBy(DB::raw('YEAR(v.fecha_hora)'))
      ->get();

      

      $articulos= DB:: table('articulos as a')
       ->select(DB::raw('count(*) as total_articulos'))
       ->get();
       $clientes= DB:: table('personas as a')
       ->select(DB::raw('count(*) as total_clientes'))
       ->get();



      return ['ingresos'=>$ingresos,'ventas'=>$ventas,'anio'=>$anio , 'articulos'=>$articulos, 'clientes'=>$clientes];   $anio=date('Y');
     
        
         
    }
    public function __invoke(Request $reques){

        $anio=date('Y');
        $ingresos=DB::table('ingresos as i')
        ->select(
        DB::raw('YEAR(i.fecha_hora) as anio'),
        DB::raw('SUM(i.total) as total'),
        DB::raw('count(*) as total_ingresos'))
        ->whereYear('i.fecha_hora',$anio)
        ->groupBy(DB::raw('YEAR(i.fecha_hora)'))
        ->get();
 
        $ventas=DB::table('ventas as v')
        ->select(
        DB::raw('YEAR(v.fecha_hora) as anio'),
        DB::raw('SUM(v.total) as total'),
        DB::raw('count(*) as total_ventas'))
        ->whereYear('v.fecha_hora',$anio)
        ->groupBy(DB::raw('YEAR(v.fecha_hora)'))
        ->get();

        

        $articulos= DB:: table('articulos as a')
         ->select(DB::raw('count(*) as total_articulos'))
         ->get();


 
        return ['ingresos'=>$ingresos,'ventas'=>$ventas,'anio'=>$anio , 'articulos'=>$articulos] ;   
    }

    public function  lineal(Request $reques)
    {
        $anio=date('Y');

        $ingresos=DB::table('ingresos as i')
        ->select(
        DB::raw(' MONTHNAME(i.fecha_hora) as mes'),

        DB::raw('SUM(i.total) as total'),
        DB::raw('count(*) as total_ingresos'))
        ->whereYear('i.fecha_hora',$anio)
        ->groupBy(DB::raw(' MONTHNAME(i.fecha_hora)'))
        ->get();

        $ventas=DB::table('ventas as v')
        ->select(
        DB::raw(' MONTHNAME(v.fecha_hora) as mes'),

        DB::raw('SUM(v.total) as total'),
        DB::raw('count(*) as total_ventas'))
        ->whereYear('v.fecha_hora',$anio)
        ->orderBy('mes', 'desc')

        ->groupBy(DB::raw(' MONTHNAME(v.fecha_hora)'))
        ->get();
 
      

 
        return ['anio'=>$anio, 'ingresos'=>$ingresos, 'ventas'=>$ventas ] ;   
    }
}
