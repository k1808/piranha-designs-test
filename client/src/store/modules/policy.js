import axios from "axios";
import {formatStaff} from "@/utils/formatStaff";
import router from "@/router";


export default {
    namespaced: true,
    state: {
        allStaff: localStorage.getItem('allStaff')!=null ? JSON.parse(localStorage.getItem('allStaff')) : null,
        staff: localStorage.getItem('staff')!=null ? JSON.parse(localStorage.getItem('staff')) : null,
        freePolicies: localStorage.getItem('freePolicies')!=null ? localStorage.getItem('freePolicies') : null,
        showStaff: localStorage.getItem('showStaff')!=null ? JSON.parse(localStorage.getItem('showStaff')) : null,
        loader: false,
    },
    getters: {
        allStaff: (state) => state.allStaff,
        staff: (state) => state.staff,
        freePolicies: (state) => state.freePolicies,
        showStaff: (state)=>state.showStaff,
        loader: (state) => state.loader,
    },
    mutations: {
        setAllStaff: (state, staff) => state.allStaff = staff,
        setFreePolicies: (state, policies) => state.freePolicies = policies,
        setStaff: (state, staff) => state.staff = staff,
        setLoader: (state, loader) => state.loader = loader,
        setShowStaff: (state, id) => state.showStaff = id
    },
    actions: {

        showStaff({commit, rootGetters}, id){
            commit('setLoader', true);
            axios.get('/api/show-staff/' + id
                , {
                    headers: {
                        Authorization: `Bearer ${rootGetters['auth/auth']}`
                    }
                }
            ).then(res=>{
                console.log(res.data.data);
                commit('setShowStaff', res.data.data);
                commit('setLoader', false);
                localStorage.setItem("showStaff", JSON.stringify(res.data.data));
            }).catch(err=>{
                console.log(err);
            })


        },

        loadingStaff({commit, rootGetters}){
            commit('setLoader', true);
            axios.get('/api/all-staff'
                , {
                    headers: {
                        Authorization: `Bearer ${rootGetters['auth/auth']}`
                    }
                }
                ).then(res=>{
                    let staff = formatStaff(res.data.data);
                    commit('setAllStaff' , staff);
                    commit('setLoader', false);
                localStorage.setItem("allStaff", JSON.stringify(staff));

                }).catch(err=>{
                    console.log(err);
                })
        },

        loadingEditStaff({commit, rootGetters, dispatch}, id){
            commit('setLoader', true);
            axios.get('/api/edit-staff/' + id
                , {
                    headers: {
                        Authorization: `Bearer ${rootGetters['auth/auth']}`
                    }
                }
            ).then(res=>{
                let staff = res.data.data;
                console.log(res.data.data);
                commit('setStaff' , staff);
                commit('setLoader', false);
                localStorage.setItem("staff", JSON.stringify(staff));
                dispatch('loadingFreePolicies', staff.id);
            }).catch(err=>{
                console.log(err);
            })
        },
        loadingDashboardStaff({commit, rootGetters, dispatch}){
            commit('setLoader', true);
            axios.get('/api/dashboard-staff/', {
                    headers: {
                        Authorization: `Bearer ${rootGetters['auth/auth']}`
                    }
                }
            ).then(res=>{
                commit('setFreePolicies' , res.data.data);
                commit('setLoader', false);
                localStorage.setItem("freePolicies", JSON.stringify(res.data.data));
            }).catch(err=>{
                console.log(err);
            })
        },

        loadingFreePolicies({commit, rootGetters}, user){
            commit('setLoader', true);
            axios.get('/api/free-policies/' + user
                , {
                    headers: {
                        Authorization: `Bearer ${rootGetters['auth/auth']}`
                    }
                }
            ).then(res=>{
                let staff = res.data.data;
                commit('setFreePolicies' , staff);
                commit('setLoader', false);
                localStorage.setItem("freePolicies", JSON.stringify(staff));

            }).catch(err=>{
                console.log(err);
            })
        },
        addPolicyForUser({commit, rootGetters}, data) {
            commit('setLoader', true);
            axios.post('/api/add-policy-for-user/', data, {
                    headers: {
                        Authorization: `Bearer ${rootGetters['auth/auth']}`
                    }
                }
            ).then(res => {
                commit('setStaff' , res.data.editStaff);
                localStorage.setItem("staff", JSON.stringify(res.data.editStaff));
                commit('setFreePolicies' , res.data.freePolicy);
                localStorage.setItem("freePolicies", JSON.stringify(res.data.freePolicy));
                commit('setLoader', false);
            }).catch(err => {
                console.log(err);
            })
        },
        removePolicyForUser({commit, rootGetters}, data) {
            commit('setLoader', true);
            axios.post('/api/remove-policy-for-user/', data, {
                    headers: {
                        Authorization: `Bearer ${rootGetters['auth/auth']}`
                    }
                }
            ).then(res => {
                console.log(res.data);
                commit('setStaff' , res.data.editStaff);
                localStorage.setItem("staff", JSON.stringify(res.data.editStaff));
                commit('setFreePolicies' , res.data.freePolicy);
                localStorage.setItem("freePolicies", JSON.stringify(res.data.freePolicy));
                commit('setLoader', false);
            }).catch(err => {
                console.log(err);
            })
        },

        removeAllPolicyForUser({commit, rootGetters}, data) {
            commit('setLoader', true);
            axios.post('/api/remove-all-policy-for-user/', data, {
                    headers: {
                        Authorization: `Bearer ${rootGetters['auth/auth']}`
                    }
                }
            ).then(res => {
                console.log(res.data.editStaff);
                commit('setStaff' , res.data.editStaff);
                localStorage.setItem("staff", JSON.stringify(res.data.editStaff));
                commit('setFreePolicies' , res.data.freePolicy);
                localStorage.setItem("freePolicies", JSON.stringify(res.data.freePolicy));
                commit('setLoader', false);
            }).catch(err => {
                console.log(err);
            })
        }
    }
}