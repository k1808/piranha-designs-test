import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import auth from "@/middleware/auth";

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/login',
    name: 'login',
    component: () => import('../views/LoginView.vue')
  },
  {
    path: '/all-staff',
    name: 'all-staff',
    component: () => import('../views/AllStaffVue.vue')
  }, {
    path: '/edit-staff/:id',
    name: 'edit-staff',
    component: () => import('../views/EditStaffVue.vue')
  }, {
    path: '/dashboard-staff',
    name: 'dashboard-staff',
    component: () => import('../views/DashboardStaffVue.vue')
  },
  {
    path: '/dashboard-show/:id',
    name: 'dashboard-show',
    component: () => import('../views/DashboardShowVue.vue')
  }

]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})
router.beforeEach(auth);
export default router
