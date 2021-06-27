import { getField, updateField } from 'vuex-map-fields';
import router from "../../../router";
import {AuthService} from "../../../services/AuthService";
const authService = new AuthService();


const Auth = {
    namespaced: true,
    state: {
        formData: {
            login:{
                username:'',
                password:''
            }
        },
        authUser: {
            email:'',
            name:''
        },
        isAuthenticated:false,
        accessToken:null
    },
    mutations: {
        updateField,
        setLoginFormData(state, loginFormData) {
            state.formData.login = Object.assign(state.formData.login, loginFormData);
        },
        setAuthUser(state, authUser) {
            state.authUser = authUser;
        },
        setIsAuthenticated(state, isAuth){
            state.isAuthenticated = isAuth;
        },
        setAccessToken(state, token){
            state.accessToken = 'Bearer ' + token;
        }
    },
    actions: {
        loginRequest({commit, dispatch},formData) {
            return authService.login(formData).then(async response => {
                console.log("response====>", response.data)
                if (response.data.access_token){
                    await commit('setAccessToken', response.data);
                    dispatch('loginSuccess', response.data)
                }
            });
        },
        loginSuccess({commit}, authResponse){
            commit('setIsAuthenticated', true);
            localStorage.setItem('tokenData', JSON.stringify(authResponse) );
            router.push('/')
        },
        logout({dispatch, commit}){
            return authService.logOut().then(async response => {
                if (response.status === 204){
                    await commit('setAccessToken', '');
                    dispatch('logoutSuccess', response.data)
                }
            });

        },
        logoutSuccess({commit}){
            commit('setIsAuthenticated', false);
            localStorage.removeItem('tokenData');
            router.push('/login')
        },
    },
    getters: {
        getField,
        isAuthenticated(state) {
            return state.isAuthenticated;
        },
        authUser(state) {
            return state.authUser;
        },
        accessToken() {
            let token = localStorage.getItem('tokenData');
            return JSON.parse(token);
        }
    }
};
export default Auth;
