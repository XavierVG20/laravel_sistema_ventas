<script>
import { Pie } from "vue-chartjs";

export default {
  extends: Pie,
    data (){
            return {
                etiquetas:[],
                datos:[]
            }
        },
 methods : {
    listarventas() {
        let me = this;

        var url = "/dashboard";
  axios.get(url)
          .then(response=>{
             response.data.ventas.forEach(element => {
                me.etiquetas.push("Ventas")
                
                me.datos.push(element.total)
                console.log(element);
            }) 
            response.data.ingresos.forEach(element => {
                me.etiquetas.push("Ingresos")

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
   async mounted() {

this.listarventas();
    this.gradient = this.$refs.canvas
      .getContext("2d")
      .createLinearGradient(0, 0, 0, 450);
    this.gradient2 = this.$refs.canvas
      .getContext("2d")
      .createLinearGradient(0, 0, 0, 450);

    this.gradient.addColorStop(0, "rgba(255, 0,0, 0.5)");
    this.gradient.addColorStop(0.5, "rgba(255, 0, 0, 0.25)");
    this.gradient.addColorStop(1, "rgba(255, 0, 0, 0)");

    this.gradient2.addColorStop(0, "rgba(0, 231, 255, 0.9)");
    this.gradient2.addColorStop(0.5, "rgba(0, 231, 255, 0.25)");
    this.gradient2.addColorStop(1, "rgba(0, 231, 255, 0)");
   await this.renderChart(
      {
        labels: this.etiquetas,
        datasets: [
          {
            backgroundColor: [this.gradient, this.gradient2, "#00D8FF"],
            data: this.datos
          }
        ]
      },
      { responsive: true, maintainAspectRatio: false }
    );
  }
};
</script>