<script>
import { Line } from "vue-chartjs";

export default {
  extends: Line,
  data() {
    return {
      etiquetas:[],
      datos: [],
      gradient: null,
      gradient2: null
    };
  },
 async mounted() {
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
      let me = this;

        var url = "/lineal";
      await  axios.get(url)
          .then(response=>{
                 console.log(response)
             response.data.ventas.forEach(element => {
               

            me.etiquetas.push(element.mes)

                me.datos.push(element.total)
            }) 
              
          })
          .catch(function (error) {
            console.log(error);
          });

    this.renderChart(
      {
        labels: this.etiquetas,
        datasets: [
          {
            label: "Total Ventas",
            borderColor: "#FC2525",
            pointBackgroundColor: "white",
            borderWidth: 1,
            pointBorderColor: "white",
            backgroundColor: this.gradient,
            data: this.datos
          }
        
        ]
      },
      { responsive: true, maintainAspectRatio: false }
    );
  }
};
</script>
