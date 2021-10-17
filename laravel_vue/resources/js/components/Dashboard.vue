<template>
  <div style="background: #ccc">
    <div class="row">
      <div class="col-12">
        <TotalStatistic />
      </div>
    </div>
    <div class="row">
      <div class="col-8">
        <Chart />
      </div>
      <div class="col-4">
        <Piechart />
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card m-3">
         
          <div class="card-body">
            <h5 class="card-title">User Lists</h5>

            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Student Name</th>
                  <th scope="col">Enrolment</th>
                  <th scope="col">Email</th>
                  <th scope="col">Course</th>
                  <th scope="col">Operation</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="item in user_list" v-bind:key="item.id">
                  <th scope="row">1</th>
                  <td>{{ item.firstname }} {{ item.lastname }}</td>
                  <td>{{ item.enrole_type }}</td>
                  <td>{{ item.email }}</td>
                  <td>{{ item.curse_name }}</td>
                  <td>
                    <button class="btn btn-sm btn-default">Edit</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!--.......................-->
  </div>
  <!--
    <div>
        Dashboard <br>
        <div v-if="user">
        Name: {{user.name}} <br>
        Email: {{user.email}}<br><br>
        <button @click.prevent="logout">Logout</button>
        </div>

    </div>-->
</template>
<script>
import Chart from "./Chart";
import Piechart from "./Piechart";
import TotalStatistic from "./TotalStatistic.vue";

export default {
  name: "Dashboard",
  components: {
    Chart,
    Piechart,
    TotalStatistic,
  },
  data() {
    return {
      user: null,
      user_list: null,
    };
  },
  methods: {
    logout() {
      axios.post("/api/logout").then(() => {
        this.$router.push({ name: "Home" });
      });
    },
  },
  mounted() {
    axios.get("/api/get_user_erolment_list").then((res) => {
      this.user_list = res["data"];
    });

    axios.get("/api/user").then((res) => {
      this.user = res.data;
    });
  },
};
</script>