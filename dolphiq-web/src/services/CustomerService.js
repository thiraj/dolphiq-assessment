import Vue from 'vue';


export class CustomerService {

    fetchCustomers = (filters) => {
        return Vue.prototype.$apiClient.get( 'customers/filter', filters);
    };

    storeCustomer = async (customerData) => {
        let postParams = customerData;
        postParams.phone_numbers = await customerData.phone_numbers.map(({ phone_number }) => phone_number);
        return Vue.prototype.$apiClient.send('POST', 'customer', postParams);
    };

    updateCustomer = async (customerData) => {
        return Vue.prototype.$apiClient.send('PUT', 'customer', customerData);
    };

    deleteCustomer = async (customerData) => {
        let postParams = {
            id: customerData.id
        };
        return Vue.prototype.$apiClient.send('DELETE', 'customer', postParams);
    };

    importCustomers = async (csvFile) => {
        let formData = new FormData();
        formData.append('customers', csvFile);
        return Vue.prototype.$apiClient.send('POST', 'customers/import', formData, {headers:{'Content-Type': 'multipart/form-data',}});
    };

    // getAuthUser = () => {
    //
    // }
}