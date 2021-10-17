<template>
  <div class="m-3">
      <highcharts  class="hc"  :options="chartOptions" :updateArgs="updateArgs"></highcharts>  
  </div>
</template>

<script>
import Highcharts from "highcharts";

export default {
  props: ["data", "title"],
  data() {
    return {
       data_list: null,
      chartOptions: {
        chart: {
          plotBackgroundColor: null,
          plotBorderWidth: null,
          plotShadow: false,
          type: "pie"
        },
        exporting: {
          enabled: false
        },
        title: {
          text: ""
        },
        series: [
          {
            data: this.data_list
          }
        ]
      },
      updateArgs: [true, true, { duration: 1000 }]
    };
  },
  watch: {
    title(newValue) {
      this.chartOptions.title.text = newValue;
    },
    data(newValue, oldValue) {
        console.log("pie watch fired",newValue)
      for (let obj of newValue) {
        let x = this.$children[0].chart.series[0].data.findIndex(
          s => s.name == obj.name
        );
        if (x != -1) {
            console.log("pair found",obj,obj.y)
          this.$children[0].chart.series[0].data[x].update(obj.y);
        } else {
          //New key value pair
        }
      }
    }
  },
  mounted() 
  {
    if (typeof this.title !== "undefined") {
      this.chartOptions.title.text = this.title;
    }
    axios.get("/api/get_enrol_methods").then((res) => 
    {
        this.chartOptions.series[0].data  = res['data'];
        /*
        this.data_list =  [
                {
                    name: "test",
                    y: 29.9
                },
                {
                    name: "test2",
                    y: 29.9
                },
                {
                    name: "test3",
                    y: 29.94
                }
        ];*/       
    });

  },
  methods: {
    async fillData() {
      await axios.get('/api/get_total_records')
        .then((response) => {

            console.log('mmmmmmm',response);

          //this.chartOptions.series[0].data = response.data.map((m) => m.env_light);
        });
    },
  },

};
</script>

<style>
.hc {
  height: 400px;
}
</style>
