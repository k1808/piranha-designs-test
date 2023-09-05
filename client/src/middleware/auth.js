import { computed } from 'vue'
import store from '@/store'
export default function auth(to, from, next) {
    const isAuthenticated = computed(() => {
        return store.getters['auth/auth'] !== null
    })

    const isAdmin = computed(() => {
        return store.getters['auth/role'] == 1
    })

    if (!isAuthenticated.value) {
        if (!['login', 'home'].includes(to.name)) {
            next({ name: 'login' });
        } else {
            next() ;
        }
    } else {
        console.log(isAdmin);
        console.log(to.name);
        if (isAdmin.value) {
            if (!['all-staff', 'edit-staff'].includes(to.name)) {
                next({ name: 'all-staff' });
            } else {
                next() ;
            }
        } else {
            if (!['dashboard-staff', 'dashboard-show'].includes(to.name)) {
                next({ name: 'dashboard-staff' });
            } else {
                next() ;
            }
        }
    }
}