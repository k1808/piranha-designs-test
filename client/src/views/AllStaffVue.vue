<script setup>

import HeaderVue from "@/components/HeaderVue.vue";
import FooterVue from "@/components/FooterVue.vue";
import Loader from "@/components/Loader.vue";
import {ref, computed} from "vue";
import { useStore } from 'vuex'
import { useRouter, useRoute } from 'vue-router'

const store = useStore()
store.dispatch('policy/loadingStaff')
const allStaff = computed(() => store.getters['policy/allStaff']);
const loader = computed(() => store.getters['policy/loader']);
const router = useRouter();
const editStaff = (el, router) => {

    router.push({
      name: 'edit-staff',
      params: {
        id: el.id
      }
    });

}
</script>

<template>
  <div class="all-staff">
    <header-vue/>
    <div class="wrapper">
      <div class="container">

        <!-- Page-Title -->
        <div class="row">
          <div class="col-sm-12" style="padding-bottom: 20px;">
            <div class="btn-group m-t-15">

            </div>
          </div>
        </div>
        <!-- end row -->


        <div class="row">
          <div class="col-12">
            <div class="card-box table-responsive">
              <div class="header">
                <h3>Staff <button class="btn btn-primary waves-effect waves-light pull-right" data-toggle="modal" data-target="#sendInvitation"><i class="fa fa-plus"></i> Create Account</button></h3>
              </div>
              <template v-if="loader">
                <Loader/>
              </template>
              <table v-else id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Last Operation</th>
                  <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(el, index) in allStaff" :key="index" @click="editStaff(el, router)" style="cursor: pointer">

                  <td>{{ el.name }}</td>
                  <td>{{ el.email }}</td>
                  <td>{{ !el.last_operations ? '-' : el.last_operations.last_operation }}</td>
                  <td><span class="label" :class="el.status? 'label-success': 'label-info'">
                    <template v-if="el.status" >Active</template>
                    <template v-else >Invitation Sent</template>
                  </span></td>
                </tr>
                </tbody>
              </table>
            </div>
          </div>

          <!-- Modal -->
          <div class="modal fade" id="sendInvitation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Send Invitation</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form>
                    <fieldset class="form-group">
                      <label>Name</label>
                      <input type="text" name="name" class="form-control" required/>
                    </fieldset>

                    <fieldset class="form-group">
                      <label>Email</label>
                      <input type="email"  name="email" class="form-control" required/>
                    </fieldset>

                    <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-paper-plane-o"></i> Send</button>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- end row -->


      </div> <!-- container -->


      <!-- Footer -->
      <footer-vue />
      <!-- End Footer -->

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