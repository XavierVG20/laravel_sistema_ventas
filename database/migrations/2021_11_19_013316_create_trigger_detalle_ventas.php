<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTriggerDetalleVentas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER tr_d AFTER INSERT ON ` detalle_ventas` FOR EACH ROW
        BEGIN
        update articulos set articulos.stock = articulos.stock - new.cantidad where articulos.id = new.idarticulo;
        END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER ` tr_d`');
    }
}
