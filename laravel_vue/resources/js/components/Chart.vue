<template>
  <div class="m-3">
    <highcharts class="hc" :options="chartOptions" ref="chart"></highcharts>
  </div>
</template>

<script>
import Highcharts from "highcharts";

export default {
  methods: {
    formatNumber(val, currencySymbol) {
      return val + this.currencySymbol
    }
  },
  data() {
    return {
      currencySymbol: " ",
      title: "Enrolment vs Completions",
      points: [10, 0, 8, 2, 6, 4, 5, 5],
      chartType: "Spline"
    };
  },
  computed: {
    chartOptions() {
      var ctx = this,
        symbol = ctx.currencySymbol;

      return {
        chart: {
          type: this.chartType.toLowerCase()
        },
        title: {
          text: "Enrolment vs Completions"
        },
        yAxis: {
          gridLineDashStyle: "Dot",
          labels: {
            style: {
              color: "#000"
            },
            formatter: label => {
              return (
                symbol + Highcharts.Axis.prototype.defaultLabelFormatter.call(label)
              );
            }
          }
        },
        tooltip: {
          formatter: function () {
            return this.x+'/'+this.y
          }                    
        },
        series: [
          {
            data: ctx.points,
            color: "#6fcd98"
          },
           {
            data: [11, 0, 8, 1, 6, 2, 5, 3],
            color: "#cc9d98"
          }
        ]
      };
    }
  },

  mounted() 
  {
    if (typeof this.title !== "undefined") {
      this.chartOptions.title.text = this.title;
    }
    axios.get("/api/get_enrol_vs_completion").then((res) => 
    {
        res['data'].forEach(([key, value]) => {
            this.chartOptions.series[key].data  = res['data'][key];  
        });
    });

  },
};
</script>

<style>
.hc {
  height: 400px;
}
</style>
