<script>
  import { Bar } from 'vue-chartjs'

  export default {
    extends: Bar,
    data() {
      return {
          etiquetas: [  ],
     
            etiqueta: 'Bar Chart',
            borderWidth1: 1,
            backgroundColor1: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)',
           
            ],
            borderColor1: [
              'rgba(255,99,132,1)',
              'rgba(54, 162, 235, 1)',
         
            ],
            pointBorderColor1: '#2554FF',
            datos: [],
        
        
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              },
              gridLines: {
                display: true
              }
            }],
            xAxes: [{
              gridLines: {
                display: false
              }
            }]
          },
          legend: {
            display: true
          },
          responsive: true,
          maintainAspectRatio: false
        }
      }
    },
   async mounted() {
     let me = this;

        var url = "/dashboard";
      await  axios.get(url)
          .then(response=>{
             me.etiquetas.push("Ventas")
             me.etiquetas.push("Ingresos")            
             response.data.ventas.forEach(element => {

               // me.backgroundColor2.push("gba(255, 99, 132, 0.2)")
                me.datos.push(element.total)
            }) 
            response.data.ingresos.forEach(element => {

              // me.backgroundColor2.push(" 'rgba(54, 162, 235, 0.2)'")

                me.datos.push(element.total)
            })  
              
          })
          .catch(function (error) {
            console.log(error);
          });

      this.renderChart({
        labels: this.etiquetas,
        datasets:[{
            backgroundColor : this.borderColor1,
           
              data : this.datos
        }],} , this.options)
    }
  }
</script>