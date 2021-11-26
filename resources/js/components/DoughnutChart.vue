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
      async mounted() {
       let me = this;

        var url = "/dashboard";
      await  axios.get(url)
          .then(response=>{
             me.labels1.push("Ventas")
                me.labels1.push("Ingresos")            
             response.data.ventas.forEach(element => {
               

                
                me.backgroundColor2.push("gba(255, 99, 132, 0.2)")
                me.datos.push(element.total)
            }) 
            response.data.ingresos.forEach(element => {

               me.backgroundColor2.push(" 'rgba(54, 162, 235, 0.2)'")

                me.datos.push(element.total)
            })  
              
          })
          .catch(function (error) {
            console.log(error);
          });
      this.renderChart({
        labels: this.labels1,
        datasets:[{
          label:'ingresos y ventas',
            backgroundColor : this.borderColor2,
           
              data : this.datos
        }],}, this.options)
    },
  
     methods: {
   
   },
   
  }
</script>