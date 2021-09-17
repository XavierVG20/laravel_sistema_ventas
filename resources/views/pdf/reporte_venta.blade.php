<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>factura</title>
        <style>
            * {
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
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
                padding: 15px;
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
            <style>
                @page { margin-top: 140px;}
                header {
                    top: -100px;
                    position: fixed;
                }
            </style>

    </head>
    <body>
        <header>
            <div style="position:absolute; left:0pt; width:250pt;">
                <img class="img-rounded" height="" src="">
            </div>
            <div style="margin-left:300pt;">
                <b>Fecha: </b><br />
           
                    <b>Fecha de vencimiento: </b><br />

              
                    <b>Factura : </b>  
          
                <br />
            </div>
            <br />
            <h2>
            {!! QrCode::generate('Make me into a QrCode!'); !!}
    <p>Escanéame para volver a la página principal.</p>
            </h2>
        </header>
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
                          
                        Sr(a). {{$v->nombre}}<br>
                            {{$v->tipo_documento}}: {{$v->num_documento}}<br>
                            Dirección: {{$v->direccion}}<br>
                            Teléfono: {{$v->telefono}}<br>
                            Email: {{$v->email}}<br>
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