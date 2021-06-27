import axios from 'axios';
import toast from "../utils/toast";

export default {

    install: (Vue) => {
        const metaObj = {
            //defined http methods
            XHR_GET_METHOD: 'get',
            XHR_POST_METHOD: 'post',
            XHR_PUT_METHOD: 'put',
            XHR_DELETE_METHOD: 'delete',
            XHR_HEADER_METHOD: 'header',
            XHR_PATCH_METHOD: 'patch',
            XHR_OPTIONS_METHOD: 'options',

            //defined response types
            RESPONSE_TYPE_JSON: 'application/json',

            //local variables
            timeout: 30000,
            api_version: 'v1',

            // Default headers
            headers: {
                'Accept': 'application/json,text/html',
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Encoding': 'gzip'
            },

            loader: false,
            failed:false,
        };

        Vue.prototype.$apiClient = {
            //initialize variables and response type
            _init(method, url, data, options) {

                this.url = url;
                this.method = method;
                this.data = data;

                //axios options can be set here.
                this.timeout = options.timeout ? options.timeout : metaObj.timeout;
                this.headers = options.headers ? Object.assign(metaObj.headers, options.headers) : metaObj.headers;

            },

            //create the axios instance with settings
            _createInstance(config) {

                const httpClient = axios.create();
                httpClient.defaults.timeout = this.timeout;
                httpClient.defaults.headers = this.headers;
                httpClient.defaults.baseURL = process.env.VUE_APP_API_BASE_URL;

                let tokenData = localStorage.getItem('tokenData');
                if( tokenData ){
                    let accessToken = JSON.parse(tokenData);
                    httpClient.defaults.headers['Authorization'] = 'Bearer ' + accessToken.access_token;
                }

                //setting interceptors
                httpClient.interceptors.response.use(function (response) {
                    return response;

                }, function (error) {
                    toast.error(error.response.data.message)
                    return error.response;
                });

                return httpClient(config);
            },

            /**
             *
             * @param method
             * @param url
             * @param data
             * @param options
             */
            send(method, url, data, options = {}) {
                this._init(method, url, data, options);
                return this._createInstance({
                    method: this.method,
                    url: this.url,
                    data: this.data
                });
            },

            /**
             *
             * @param url
             * @param data
             * @param options
             */
            get(url, data, options = {}) {
                this._init(this.XHR_GET_METHOD, url, data, options);
                return this._createInstance({
                    method: this.method,
                    url: this.url,
                    params: this.data
                });
            }

        }
    }
}