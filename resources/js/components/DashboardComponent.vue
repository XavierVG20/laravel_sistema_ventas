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
              <h3> {{total_clientes}} </h3>

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

      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="active"><a href="#revenue-chart" data-toggle="tab">Area</a></li>
              <li><a href="#sales-chart" data-toggle="tab">Donut</a></li>
              <li class="pull-left header"><i class="fa fa-inbox"></i> Sales</li>
            </ul>
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
              <div class="chart tab-pane active" id="revenue-chart" style=" min-width: 375px;
    max-width: 1024px;
    /* margin: 30px; */
    position: relative;
    width: 100%;
    height: auto;">
                            <doughnut-chart/>


              </div>
              <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 600px;">

              </div>
            </div>
          </div>
          <!-- /.nav-tabs-custom -->



      

        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">

        
          <!-- solid sales graph -->
          <div class="box box-solid bg-teal-gradient">
            <div class="box-header">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Sales Graph</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>
            <div class="box-body border-radius-none">
              <div class="chart" id="line-chart" style=" min-width: 375px;
    max-width: 1024px;
    /* margin: 30px; */
    position: relative;
    width: 100%;
    height: 40vw;">
                           <AreaChart/>


              </div>
            </div>
          
          </div>
          <!-- /.box -->

       

        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->
      
      <PieChart/>
      <BarChart/>
      <LineChart/>
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
      total_ingresos:0,
      total_clientes:0



      
     
    };
  },
   methods: {
    async listarventas() {
        let me = this;
        var url = "/dashboard";
        await axios.get(url)
          .then(response=>{
             
            response.data.articulos.forEach(element => {
            
               this.total_articulos = element.total_articulos
             });
               response.data.ventas.forEach(element => {
               this.total_ventas = element.total_ventas
             });
               response.data.ingresos.forEach(element => {
               this.total_ingresos = element.total_ingresos
             });
              response.data.clientes.forEach(element => {
               this.total_clientes = element.total_clientes
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


