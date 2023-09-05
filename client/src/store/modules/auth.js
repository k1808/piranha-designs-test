import axios from "axios";
import router from "@/router";


export default {
    namespaced: true,
    state: {
        auth: localStorage.getItem('at')!=null ? localStorage.getItem('at') : null,
        login: localStorage.getItem('us')!=null ? localStorage.getItem('us') : null,
        role: localStorage.getItem('rl')!=null ? localStorage.getItem('rl') : null,
        loader: false,
        errMsg: null
    },
    getters: {
        auth: (state) => state.auth,
        login: (state) => state.login,
        role: (state) => state.role,
        loader: (state) => state.loader,
        errMsg: (state) => state.errMsg
    },
    mutations: {
        setAuth: (state, auth) => state.auth = auth,
        setLogin: (state, login) => state.login = login,
        setError: (state, e) => state.errMsg = e,
        setRole: (state, role) => state.role = role
    },
    actions: {

        login({commit}, data){
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/api/login', data).then(res=>{
                    commit('setError' ,null);
                    commit('setAuth', res.data.token);
                    commit('setLogin', res.data.user.name);
                    commit('setRole', res.data.user.role.id);
                    localStorage.setItem('at', res.data.token);
                    localStorage.setItem('rl', res.data.user.role.id);
                    localStorage.setItem('us', res.data.user.name);

                    if(res.data.user.role.id==1){
                        router.push({ name: 'all-staff'})
                    } else {
                        router.push({ name: 'dashboard-staff'})
                    }
                }).catch(err=>{
                    commit('setError' ,err.response.data.message);
                })
            });
        },
        async signOut({commit}) {
            await axios.post('/api/logout').then(res=>{
                commit('setError' ,null);
                commit('setAuth', null);
                commit('setLogin', null);
                commit('setRole', null);
                localStorage.removeItem('at');
                localStorage.removeItem('rl');
                localStorage.removeItem('us');
                router.push({ name: 'home'});
            })

        },

        async changeNameUser({commit, getters}, data){
            await axios.post('/api/change-login', data, {
                    headers: {
                        Authorization: `Bearer ${getters['auth']}`
                    }
                }
            )
                .then(res=>{
                 commit('setLogin', res.data.data.name);
                 localStorage.setItem('us', res.data.data.name);
            })
        }
    }
}