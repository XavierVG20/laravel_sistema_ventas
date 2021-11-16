<!DOCTYPE>
<html>
    <head>
        <title>Factura</title>
        <link rel="stylesheet" type="text/css" href="css/fac.css">
    </head>
    <style>
        body {
  /*position: relative;*/
  /*width: 16cm;  */
  /*height: 29.7cm; */
  /*margin: 0 auto; */
  /*color: #555555;*/
  /*background: #FFFFFF; */
  font-family: Arial, sans-serif; 
  /*font-size: 15px; */
  /*font-family: SourceSansPro;*/
}

#logo{
  float: left;
  margin-top: 1%;
  margin-left: 1%;
  margin-right: 1%;
}

#imagen{
  width: 150px;
}

#datos{
  float: left;
  margin-top: 1%;
  margin-left: 1%;
  margin-right: 1%;
  /*text-align: justify;*/
}

#encabezado{
  text-align: center;
  margin-left: 10px;
  margin-right:350px;
  font-family: DejaVu Sans; 
  font-size:10px;
        font-weight: normal;
}

#fact{
  /*position: relative;*/
  float: right;
  margin-top: 2%;
  margin-left: 2%;
  margin-right: 2%;
  font-size: 20px;
}

h1,h2,h3,h4,h5,h6,p,span,div { 
                font-family: DejaVu Sans; 
                font-size:10px;
                font-weight: normal;
            }
            th,td { 
                font-family: DejaVu Sans; 
                font-size:10px;
            }
            .panel {
                margin-bottom: 20px;
                background-color: #fff;
                border: 1px solid transparent;
                border-radius: 4px;
                -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);
                box-shadow: 0 1px 1px rgba(0,0,0,.05);
            }
            .panel-default {
                border-color: #ddd;
            }
            .panel-body {
                padding: 10px;
            }
            table {
                width: 100%;
                max-width: 100%;
                margin-bottom: 0px;
                border-spacing: 0;
                border-collapse: collapse;
                background-color: transparent;
            }
            thead  {
                text-align: left;
                display: table-header-group;
                vertical-align: middle;
            }
            th, td  {
                border: 1px solid #ddd;
                padding: 6px;
            }
            .well {
                min-height: 20px;
                padding: 19px;
                margin-bottom: 20px;
                background-color: #f5f5f5;
                border: 1px solid #e3e3e3;
                border-radius: 4px;
                -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.05);
                box-shadow: inset 0 1px 1px rgba(0,0,0,.05);
            }
    </style>
    <body>
    @foreach ( $empresa_datos as $e )
        <header>
            <div id="logo">
                <img src="{{$e->file_url}}" alt="Compuzoft" id="imagen">
            </div>
            <div id="datos">
                <p id="encabezado">
                    <b>{{$e->nombre_empresa}}</b><br>{{$e->direccion}}<br>Telefono:{{$e->telefono}}<br>Email:{{$e->email}}
                </p>
            </div>
            <div id="fact">
            <div style="margin-left:300pt;">
                <b>Fecha: {{ date('d-m-Y ') }} </b><br />
           
                    <b>Fecha de vencimiento: {{ date('d-m-Y ') }} </b><br />

              
                    <b>Factura : </b>  
          
                <br />
            </div>
            </div>
        </header>
        @endforeach
        <main>
        @foreach ($venta as $v)
            <div style="clear:both; position:relative;">
                <div style="position:absolute; left:0pt; width:250pt;">
                    <h4>Detalle Cliente:</h4>
                    <div class="panel panel-default">
                        <div class="panel-body">
                        Sr(a). {{$v->nombre}}<br>
                            {{$v->tipo_documento}}: {{$v->num_documento}}<br>
                            Dirección: {{$v->direccion}}<br>
                            Teléfono: {{$v->telefono}}<br>
                            Email: {{$v->email}}<br>
                        </div>
                    </div>
                </div>
                <div style="margin-left: 300pt;">
                    <h4>Detalle Vendedor:</h4>
                    <div class="panel panel-default">
                        <div class="panel-body">
                          
                        Sr(a). {{$v->name}}<br>
                            {{$v->tipo_documento}}: {{$v->num_documento_user}}<br>
                            Dirección: {{$v->direccion_user}}<br>
                            Teléfono: {{$v->telefono_user}}<br>
                            Email: {{$v->email_user}}<br>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
    
            <table class="table table-bordered">
                <thead>
                    <tr>
                            <th>CANT</th>
                            <th>DESCRIPCION</th>
                            <th>PRECIO UNIT</th>
                            <th>DESC.</th>
                            <th>PRECIO TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($detalles as $det)
                        <tr>
                        <td>{{$det->cantidad}}</td>
                            <td>{{$det->articulo}}</td>
                            <td>{{$det->precio}}</td>
                            <td>{{$det->descuento}}</td>
                            <td>{{$det->cantidad*$det->precio-$det->descuento}}</td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
            <div style="clear:both; position:relative;">
                    <div style="position:absolute; left:0pt; width:250pt;">
                        <h4>Gracias por su compra</h4>
                        <div class="panel panel-default">
                            <div class="panel-body">
                            </div>
                        </div>
                    </div>
                <div style="margin-left: 300pt;">
                    <h4>Total:</h4>
                    <table class="table table-bordered">
                        <tbody>
                        @foreach ($venta as $v)
                            <tr>
                                <td><b>Subtotal</b></td>
                                <td>$ {{round($v->total-($v->total*$v->impuesto),2)}}</td>
                            </tr>
                                <tr>
                                    <td><b>IVA</b>
                                    </td>
                                    <td>$ {{round($v->total*$v->impuesto,2)}}</td>
                                </tr>
                      
                            <tr>
                                <td><b>TOTAL</b></td>
                                <td><b> $ {{$v->total}} </b></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
           
                <br /><br />
                <div class="well">
                   
                </div>
           
        </main>

    </body>
</html>