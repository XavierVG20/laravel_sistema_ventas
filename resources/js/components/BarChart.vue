<script>
 import { Bar } from 'vue-chartjs'

  export default {
    extends: Bar,
    data() {
      return {
        chartData: {
          labels: ["2015-01", "2015-02", "2015-03", "2015-04", "2015-05", "2015-06", "2015-07", "2015-08", "2015-09",
            "2015-10", "2015-11", "2015-12"
          ],
          datasets: [{
            label: 'Bar Chart',
            borderWidth: 1,
            backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)',
         
            ],
            borderColor: [
              'rgba(255,99,132,1)',
             
             
            ],
            pointBorderColor: '#2554FF',
            data: [1, 1]
          }]
        },
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
    mounted() {
      this.renderChart(this.chartData,)
    }
  }
</script>
