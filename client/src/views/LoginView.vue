<script setup>
import {ref, computed} from "vue";
import { useStore } from 'vuex'

const store = useStore()
const errMsg = computed(() => store.getters['auth/errMsg'])

const form = ref({
  email: '',
  password: '',
  rememberMe: false,
})

const submit = () => {
  store.dispatch('auth/login', form.value)
}

</script>
<template>
  <div class="login-page">
    <div class="account-pages"></div>
    <div class="clearfix"></div>
    <div class="wrapper-page">

      <div class="account-bg">
        <div class="card-box mb-0">
          <div class="m-t-10 p-20">
            <div class="row">
              <div class="col-12 text-center">
                <h4 class="text-muted text-uppercase m-b-0 m-t-0">Sign In</h4>
              </div>
            </div>
            <form @submit.prevent="submit" class="m-t-20"  data-parsley-validate >

              <div class="form-group row">
                <div class="col-12">
                  <input type="email" v-model="form.email" placeholder="Email" class="form-control" parsley-trigger="change" required/>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-12">
                  <input type="password" v-model="form.password" placeholder="Password" class="form-control" parsley-trigger="change" required/>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-12">
                  <div class="checkbox checkbox-custom">
                    <input id="checkbox-signup" type="checkbox" v-model="form.rememberMe">
                    <label for="checkbox-signup">
                      Remember me
                    </label>
                  </div>
                </div>
              </div>

              <div class="form-group text-center row m-t-10">
                <div class="col-12">
                  <button class="btn btn-success btn-block waves-effect waves-light" type="submit">Log In</button>
                </div>
              </div>
              <p class="badge-danger" v-if="errMsg">{{errMsg}}</p>

            </form>

          </div>

          <div class="clearfix"></div>
        </div>
      </div>

    </div>
  </div>
</template>