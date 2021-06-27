import Vue from "vue";
import Vuex from "vuex";
import createPersistedState from "vuex-persistedstate";
import SecureLS from "secure-ls";
const ls = new SecureLS({ isCompression: false });
import Auth from "./modules/auth/auth";
import Customer from "./modules/customers/customer";

Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    Auth,
    Customer
  },
  plugins: [
    createPersistedState({
      paths:['Auth'],
      storage: {
        getItem: (key) => ls.get(key),
        setItem: (key, value) => ls.set(key, value),
        removeItem: (key) => ls.remove(key)
      }
    })
  ],
});
