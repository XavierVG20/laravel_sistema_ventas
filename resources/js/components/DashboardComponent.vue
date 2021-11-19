<template>
  <main class="main">
      <!-- Breadcrumb -->
      <section class="content-header">
        <h1>
          Dashboard
          <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
          <li class="active">Dashboard</li>
        </ol>
      </section>
      <section class="content">
          <!-- Ejemplo de tabla Listado -->
         <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{total_ventas}}</h3>

              <p>Ventas Registradas</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">ver <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3> {{total_articulos}}<sup style="font-size: 20px"></sup></h3>

              <p>Articulos Registrados</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">ver <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>44</h3>

              <p>Clientes Registrados</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">ver <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{total_ingresos}}</h3>

              <p>Ingresos Registrados</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>

    <!-- Main row -->
      <div class="row">
          <doughnut-chart/>

      </div>
      <!-- /.row (main row) -->

      </section>

  </main>
</template>
  

<script>

import LineChart from "./LineChart.vue"
import AreaChart from "./AreaChart.vue"
import BarChart from "./BarChart.vue"
import PieChart from "./PieChart.vue"
import DoughnutChart from "./DoughnutChart.vue"


export default {
 
  components: {
    AreaChart,
    BarChart,
    LineChart,
    PieChart,
     DoughnutChart
  },
  data() {
    return {
      total_articulos:0,
      total_ventas:0,
      total_ingresos:0



      
     
    };
  },
   methods: {
    async listarventas() {
        let me = this;
        var url = "/dashboard";
        await axios.get(url)
          .then(response=>{
             
            response.data.articulos.forEach(element => {
               console.log(element.total_articulos);
               this.total_articulos = element.total_articulos
             });
               response.data.ventas.forEach(element => {
               this.total_ventas = element.total_ventas
             });
               response.data.ingresos.forEach(element => {
               this.total_ingresos = element.total_ingresos
             });
          
          })
          .catch(function (error) {
            console.log(error);
          });
      },
   },
   mounted() {
      this.listarventas();
    }
};
</script>


