<script setup>

import HeaderVue from "@/components/HeaderVue.vue";
import FooterVue from "@/components/FooterVue.vue";
import { useRoute } from 'vue-router'
import {useStore} from "vuex";
import {computed, ref} from "vue";
import Loader from "@/components/Loader.vue";

const route = useRoute();
const store = useStore();
const selectedPolicies = ref([]);
store.dispatch('policy/loadingEditStaff', route.params.id);
const staff = computed(() => store.getters['policy/staff']);
const freePolicy = computed(() => store.getters['policy/freePolicies']);
const loader = computed(() => store.getters['policy/loader']);
const  formatDate = (dateTimeString) => {
  const date = new Date(dateTimeString);
  return `${date.getDate()}/${date.getMonth() + 1}/${date.getFullYear()}`;
}

const  formatCode = (code) =>{
  return code.substring(0, 7);
}

const addClient = (id) =>{
  const index = selectedPolicies.value.indexOf(id);
  if (index === -1) {
    selectedPolicies.value.push(id);
  } else {
    selectedPolicies.value.splice(index, 1);
  }
}

const getSelectClass = (id) => {
  return selectedPolicies.value.includes(id) ? 'badge-danger' : '';
};

const addPolicyForUser = () =>  {
  store.dispatch('policy/addPolicyForUser', {
    'id': route.params.id,
    'polices': selectedPolicies.value
  });
}

const removePolicyForUser = (id) =>  {
  store.dispatch('policy/removePolicyForUser', {
    'id': route.params.id,
    'policy': id
  });
}

const removeAllPolicyForUser = () =>  {
  store.dispatch('policy/removeAllPolicyForUser', {
    'id': route.params.id
  });
}

const changeNameUser = () =>  {
  store.dispatch('auth/changeNameUser', staff.value);
}
</script>

<template>
  <div class="edit-staff">
    <header-vue/>
    <div class="wrapper">
      <div class="container">

        <!-- Page-Title -->
        <div class="row">
          <div class="col-sm-12" style="padding-bottom: 20px;">

          </div>
        </div>
        <!-- end row -->
        <div class="row">
          <div class="col-12">
            <div class="card-box table-responsive">
              <div class="header">
                <h3>Edit Staff</h3>
              </div>
              <template v-if="loader">
                <Loader/>
              </template>
              <form v-else class="col-12 padded padded-bottom padded-la">
                <div class="row">
                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                    <label>Name</label>

                    <input type="text" v-model="staff.name" class="form-control" value="Client Name" required/>
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                    <label>Email</label>
                    <input type="email" v-model="staff.email" class="form-control" value="example@email.com" disabled/>
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                    <label>Status</label><br/>
                    <span class="label label-success">Active</span>
                  </div>
                </div>
              </form>

              <div class="col-12 header">
                <h3>Policies <button class="btn btn-primary waves-effect waves-light pull-right" data-toggle="modal" data-target="#addProducts"><i class="fa fa-plus"></i> Add Policy</button></h3>
              </div>

              <div class="col-12">
                <div class="table-responsive">
                  <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                      <th>Policy</th>
                      <th>Plan Reference</th>
                      <th>Member Name</th>
                      <th>Investment House</th>
                      <th>Last Operation</th>
                      <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="policy in staff.policies" :key="policy.id">
                      <td>{{policy.code}}</td>
                      <td>{{policy.plan_reference }}</td>
                      <td>{{ policy.first_name+' ' + policy.last_name}}</td>
                      <td>{{ policy.investment_house}}</td>
                      <td>{{ formatDate(policy.last_operation) }}</td>
                      <td>
                        <a href="#" @click.prevent="removePolicyForUser(policy.id)" title="Remove" class="text-danger">Remove</a>
                      </td>
                    </tr>
                    </tbody>
                  </table>
                </div>

                <div class="row padded">
                  <div class="col-6">
                    <button @click.prevent="changeNameUser" type="submit" name="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Save</button>

                  </div>
                  <div class="col-6 text-right padded padded-top">
                    <a href="#" @click.prevent="removeAllPolicyForUser" title="Remove User" class="text-danger"><i class="fa fa-trash"></i> Remove Staff</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Modal -->
          <div class="modal fade" id="addProducts" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Available Policies</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form>
                    <div class="row">
                      <div class="col-xs-12 col-lg-12">
                        <template v-if="loader">
                          <Loader/>
                        </template>
                        <table v-else id="datatable" class="table table-striped table-bordered">
                          <thead>
                          <tr>
                            <th>Policy</th>
                            <th>Plan Reference</th>
                            <th>Member Name</th>
                            <th>Investment House</th>
                            <th></th>
                          </tr>
                          </thead>

                          <tbody>
                          <tr v-for="pol in freePolicy" :key="pol.id">
                            <td>{{formatCode(pol.code)}}</td>
                            <td>{{pol.plan_reference }}</td>
                            <td>{{pol.fullname }}</td>
                            <td>{{ pol.investment_house}}</td>
                            <td><a  @click.prevent="addClient(pol.id)" title="Add Client" class="text-site1" :class="getSelectClass(pol.id)"><i class="fa fa-plus"></i></a></td>
                          </tr>
                          </tbody>
                        </table>
                      </div>
                      <div class="col-12 padded padded-top">
                        <button type="submit" name="submit" @click.prevent="addPolicyForUser" class="btn btn-primary pull-right"><i class="fa fa-check"></i> Done</button>
                      </div>
                    </div>
                  </form>

                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- end row -->


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