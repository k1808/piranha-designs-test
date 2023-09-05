<script setup>
import { useStore } from 'vuex'
import {computed} from "vue";

const store = useStore()

const userName = computed(() => {
  if (store.getters['auth/role'] == 1) {
    return store.getters['auth/login'] + ' Admin';
  }
  return store.getters['auth/login'] + ' Staff';
});

const logout = () => {
  store.dispatch('auth/signOut')
}
</script>

<template>
<div class="header">
  <header id="topnav">
    <div class="topbar-main">
      <div class="container">

        <!-- LOGO -->
        <div class="topbar-left">
          <router-link to="/" class="logo">
            <span>Logo</span>
          </router-link>
        </div>
        <!-- End Logo container-->


        <div class="menu-extras navbar-topbar">

          <ul class="list-inline float-right mb-0">

            <li class="list-inline-item">
              <!-- Mobile menu toggle-->
              <a class="navbar-toggle">
                <div class="lines">
                  <span></span>
                  <span></span>
                  <span></span>
                </div>
              </a>
              <!-- End mobile menu toggle-->
            </li>

            <li class="list-inline-item dropdown notification-list">
              <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                 aria-haspopup="false" aria-expanded="false">
                <img src="/assets/images/users/avatar.jpg" alt="user" class="rounded-circle">
                <h5 class="text-overflow"><small>{{ userName }}</small></h5>
              </a>
              <div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview">
                <a href="#" @click.prevent="logout" class="dropdown-item notify-item">
                  <i class="zmdi zmdi-power"></i> <span>Logout</span>
                </a>

              </div>
            </li>

          </ul>

        </div> <!-- end menu-extras -->
        <div class="clearfix"></div>

      </div> <!-- end container -->
    </div>
    <!-- end topbar-main -->


    <div class="navbar-custom">
      <div class="container">
        <div id="navigation">
          <!-- Navigation Menu-->
          <ul class="navigation-menu">
            <li class="active">
              <a href="ifa-staff/index.html" title="Dashboard"><i class="zmdi zmdi-view-dashboard"></i> <span> Dashboard </span> </a>
            </li>
          </ul>
          <!-- End navigation menu  -->
        </div>
      </div>
    </div>
  </header>
  End Navigation Bar
</div>
</template>

<style scoped lang="scss">

</style>