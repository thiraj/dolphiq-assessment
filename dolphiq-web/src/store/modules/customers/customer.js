import { getField, updateField } from 'vuex-map-fields';
import {CustomerService} from "../../../services/CustomerService";
import toast from "../../../utils/toast";
const customerService = new CustomerService();

const Customer = {
    namespaced: true,
    state: {
        customer: {
            id:'',
            first_name:'',
            last_name:'',
            email:'',
            phone_numbers:[]
        },
        customersList:[]
    },
    mutations: {
        updateField,
        setCustomerData(state, customerFormData) {
            state.customer = Object.assign(state.customer, customerFormData);
        },
        setCustomerList(state, customers) {
            state.customersList = customers;
        }
    },
    actions: {
        fetchCustomers({commit}, filters) {
            return new Promise((resolve, reject) => {
                customerService.fetchCustomers(filters).then(async response => {
                    if (response.data.status_code === 200){
                        commit('setCustomerList', response.data.result);
                        resolve(response.data.result)
                    }else{
                        await commit('setCustomerList', []);
                        resolve([])
                    }
                }).catch(err => {
                    reject(err)
                })
            })
        },
        addCustomer({dispatch}, customerData){
            return new Promise((resolve, reject) => {
                customerService.storeCustomer(customerData).then(response => {
                    if (response.data.status_code === 200){
                        dispatch('fetchCustomers', {});
                        resolve(response.data.result)
                    }else{
                        resolve([])
                    }
                }).catch(err => {
                    reject(err)
                })
            })
        },
        updateCustomer({dispatch}, customerData){
            return new Promise((resolve, reject) => {
                customerService.updateCustomer(customerData).then(response => {
                    console.log('response.data.status_code', response)
                    if (response.status === 200){
                        dispatch('fetchCustomers', {});
                        resolve(response.data.result)
                        toast.success("Customer updated successfully");
                    }else{
                        resolve([])
                    }
                }).catch(err => {
                    reject(err)
                })
            })
        },
        deleteCustomer({dispatch}, customerData){
            return new Promise((resolve, reject) => {
                customerService.deleteCustomer(customerData).then(response => {
                    if (response.status === 204){
                        dispatch('fetchCustomers', {});
                        resolve(response.data.result);
                        toast.success("Customer deleted successfully");
                    }else{
                        reject("Customer delete failed")
                    }
                }).catch(err => {
                    reject(err)
                })
            })
        },
        importCustomers(state, csvFile){
            return new Promise((resolve, reject) => {
                customerService.importCustomers(csvFile).then(response => {
                    if (response.status === 204){
                        resolve(response)
                        toast.success("File is being processing in background");
                    }else{
                        reject('Something went wrong. Please try again later')
                    }
                }).catch(err => {
                    reject(err)
                })
            })
        },
    },
    getters: {
        getField,
        getCustomer(state) {
            return state.customer;
        },
        getCustomersList(state) {
            return state.customersList;
        }
    }
};
export default Customer;
