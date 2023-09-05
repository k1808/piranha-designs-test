<script setup>
import HeaderVue from "@/components/HeaderVue.vue";
import FooterVue from "@/components/FooterVue.vue";
import {useStore} from "vuex";
import Loader from "@/components/Loader.vue";
import {computed} from "vue";
import {useRouter} from "vue-router";

const store = useStore();

store.dispatch('policy/loadingDashboardStaff');
const loader = computed(() => store.getters['policy/loader']);
const freePolicy = computed(() => store.getters['policy/freePolicies']);
const router = useRouter();
const showStaff = (id, router) => {

  router.push({
    name: 'dashboard-show',
    params: {
      id: id
    }
  });

}
</script>

<template>
  <div class="dashboard-staff">
    <header-vue/>
    <template v-if="loader">
      <Loader/>
    </template>
    <div v-else class="wrapper">
      <div class="container">
        <!-- Page-Title -->
        <div class="row">
          <div class="col-sm-12">
            <h4 class="page-title">Dashboard</h4>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card-box table-responsive">
              <div class="header">
                <h3>Policies</h3>
              </div>

              <table class="table table-striped table-hover">
                <thead>
                <tr>
                  <th>Policy</th>
                  <th>Plan Reference</th>
                  <th>Member Name</th>
                  <th>Investment House</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="policy in freePolicy" :key="policy.id" @click="showStaff(policy.id, router)" style="cursor: pointer">
                  <td>{{policy.code}}</td>
                  <td>{{policy.plan_reference }}</td>
                  <td>{{policy.fullname }}</td>
                  <td>{{ policy.investment_house}}</td>
                </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div> <!-- container -->


      <footer-vue/>


    </div> <!-- End wrapper -->
  </div>
</template>

<style scoped lang="scss">

</style>
<!--<script type="text/javascript">-->
<!--$(document).ready(function() {-->
<!--  $('#datatable').DataTable();-->

<!--  //Buttons examples-->
<!--  var table = $('#datatable-buttons').DataTable({-->
<!--    lengthChange: false-->
<!--    //buttons: ['copy', 'excel', 'pdf']-->
<!--  });-->

<!--  table.buttons().container().appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');-->
<!--} );-->

<!--</script>-->