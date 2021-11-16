<script>
  import { Doughnut } from 'vue-chartjs'

  export default {
    extends: Doughnut,
    data () {
      return {
      
          labels1: [],
         
            
              borderColor2: [
              'rgba(255,99,132,1)',
              'rgba(54, 162, 235, 1)',
                              
              ],
              backgroundColor2: [
                            
              ],
              datos: [],
          
     
        options: {
          legend: {
            display: true
          },
          responsive: true,
          maintainAspectRatio: false
        }
      } 
    },
      mounted() {
      this.listarventas();
      this.renderChart({
        labels: this.labels1,
        datasets:[{
          label:'ingresos y ventas',
            backgroundColor : this.borderColor2,
           
              data : this.datos
        }],}, this.options)
    },
  
     methods: {
    listarventas() {
        let me = this;

        var url = "/dashboard";
        axios.get(url)
          .then(response=>{
             response.data.ventas.forEach(element => {
                me.labels1.push("Ventas")
                
                me.backgroundColor2.push("gba(255, 99, 132, 0.2)")
                me.datos.push(element.total)
                console.log(element);
            }) 
            response.data.ingresos.forEach(element => {
                me.labels1.push("Ingresos")
               me.backgroundColor2.push(" 'rgba(54, 162, 235, 0.2)'")

                me.datos.push(element.total)
                 console.log("hola");
            })  
              

            console.log(this.datos)
          })
          .catch(function (error) {
            console.log(error);
          });
      },
   },
   
  }
</script>