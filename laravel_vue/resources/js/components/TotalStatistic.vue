

<template>
    
        
        
            <div class="m-3">
               <div class="row">
                  <div class="col-sm-2"  v-for="item in totals" v-bind:key="item.id">
                      <div class="widget-small danger coloured-icon" style="height:98px">
                          <div class="info row">
                              <div class="col-3 col-xs-3" style="padding: 0px;">
                                <i class="far fa-chart-line"></i>
                              </div>
                              <div class="col-7 col-md-8" style="padding: 0px;">
                                  <h4 style="font-size: 0.9em;">{{item.role_name}}</h4>
                                  <p><b>{{item.total}}</b></p>
                              </div>
                          </div>
                      </div>
                  </div>
               </div>
            </div>

    
</template>
<script>
export default {
  data() {
    return {
      totals: null,
    };
  },
  mounted() {
        axios.get("/api/get_total").then((res) => {
          this.totals = res['data']['total_user'];
          
          console.log("jjjjjjjjj",this.totals);
    });
  }


}
</script>

<style>
.widget-small {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    border-radius: 4px;
    color: #FFF;
    margin-bottom: 30px;
    -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
  }
  
  .widget-small .icon {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    min-width: 85px;
    -webkit-box-align: center;
        -ms-flex-align: center;
            align-items: center;
    -webkit-box-pack: center;
        -ms-flex-pack: center;
            justify-content: center;
    padding: 20px;
    background-color: rgba(0, 0, 0, 0.2);
    border-radius: 4px 0 0 4px;
    font-size: 2.5rem;
  }
  
  .widget-small .info {
    -webkit-box-flex: 1;
        -ms-flex: 1;
            flex: 1;
    padding: 0 20px;
    -ms-flex-item-align: center;
        align-self: center;
  }
  
  .widget-small .info h4 {
    text-transform: uppercase;
    margin: 0;
    margin-bottom: 5px;
    font-weight: 400;
    font-size: 1.1rem;
  }
  
  .widget-small .info p {
    margin: 0;
    font-size: 16px;
  }
  
  .widget-small.primary {
    background-color: #009688;
  }
  
  .widget-small.primary.coloured-icon {
    background-color: #fff;
    color: #2a2a2a;
  }
  
  .widget-small.primary.coloured-icon .icon {
    background-color: #009688;
    color: #fff;
  }
  
  .widget-small.info {
    background-color: #17a2b8;
  }
  
  .widget-small.info.coloured-icon {
    background-color: #fff;
    color: #2a2a2a;
  }
  
  .widget-small.info.coloured-icon .icon {
    background-color: #17a2b8;
    color: #fff;
  }
  
  .widget-small.warning {
    background-color: #ffc107;
  }
  
  .widget-small.warning.coloured-icon {
    background-color: #fff;
    color: #2a2a2a;
  }
  
  .widget-small.warning.coloured-icon .icon {
    background-color: #ffc107;
    color: #fff;
  }
  
  .widget-small.danger {
    background-color: #dc3545;
  }
  
  .widget-small.danger.coloured-icon {
    background-color: #fff;
    color: #2a2a2a;
  }
  
  .widget-small.danger.coloured-icon .icon {
    background-color: #dc3545;
    color: #fff;
  }
  
</style>