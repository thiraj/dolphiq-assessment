export const actionTypes = {
    AUTH_ACTIONS : {
        LOGIN_REQUEST : 'LOGIN_REQUEST',
        LOGIN_SUCCESS : 'LOGIN_SUCCESS',
        LOGIN_FAILED : 'LOGIN_FAILED',
        FETCH_AUTH_USER : 'FETCH_AUTH_USER',
        LOGOUT : 'LOGOUT',
    },
    CUSTOMER_ACTIONS : {
        FETCH_CUSTOMERS : 'FETCH_CUSTOMERS',
        FETCH_CUSTOMERS_FAILED : 'FETCH_CUSTOMERS_FAILED',
        UPDATE_CUSTOMER : 'UPDATE_CUSTOMER',
        UPDATE_CUSTOMER_SUCCESS : 'UPDATE_CUSTOMER_SUCCESS',
        UPDATE_CUSTOMER_FAILED : 'UPDATE_CUSTOMER_FAILED',
        DELETED_CUSTOMER : 'DELETED_CUSTOMER',
        DELETE_CUSTOMER_SUCCESS : 'DELETE_CUSTOMER_SUCCESS',
        DELETE_CUSTOMER_FAILED : 'DELETE_CUSTOMER_FAILED',
    }

}