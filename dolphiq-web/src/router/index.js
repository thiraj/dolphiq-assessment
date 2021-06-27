import Vue from "vue";
import VueRouter from "vue-router";
import store from '../store'
import Home from "../views/Home.vue";
import Login from "../views/auth/Login";

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home,
    meta: { auth:true }
  },
  {
    path: "/login",
    name: "Login",
    component: Login,
  },
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes,
});

router.beforeEach((to, from, next) => {
  if(to.matched.some(record => record.meta.auth)) {
    if (store.getters['Auth/isAuthenticated']) {
      next()
      return
    }
    next('/login')
  } else if (to.matched.some(record => record.name === 'Login')) {
    if (!store.getters['Auth/isAuthenticated']) {
      next()
      return
    }
    next('/')
  } else {
    next()
  }
})

export default router;
