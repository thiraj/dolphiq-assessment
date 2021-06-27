import Vue from 'vue';


export class AuthService {

    login = (formData) => {
        let postParams = {
            client_id: process.env.VUE_APP_API_CLIENT_ID,
            client_secret: process.env.VUE_APP_API_CLIENT_SECRET,
            grant_type:'password',
            username:formData.username,
            password:formData.password,
            scope:''
        }
        return Vue.prototype.$apiClient.send('POST', 'oauth/token', postParams);
    };

    logOut = () => {
        return Vue.prototype.$apiClient.send('GET', 'oauth/logout');
    }
}