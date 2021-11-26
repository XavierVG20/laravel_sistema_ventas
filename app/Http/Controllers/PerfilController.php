<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
   public function index(){
   // if (!$request->ajax())   return view('perfil');
$ide = \Auth::user();
    $personas = User::join('roles','users.idrol','=','roles.id')
    ->select('users.id','users.name','users.tipo_documento','users.num_documento','users.direccion','users.telefono','users.email','users.password','users.condicion','users.idrol','roles.nombre as rol')
   ->where('users.id','==',$ide);

   return ['articulos' => $ide];

    }

    public function FunctionName(Type $var = null)
    {
        # code...
    }
}
