import Vue from 'vue';
import VueRouter from 'vue-router';
 import Register from './crm/Component/Views/Auth/Register.vue';
 import Login from './crm/Component/Views/Auth/Login.vue';
 import PasswordReset from './crm/Component/Views/Auth/PasswordReset.vue';
 import Dashboard from './crm/Component/Views/Dashboard/Dashboard.vue';
// import About from './components/About.vue';
// import Contact from './components/Contact.vue';

Vue.use(VueRouter);

const routes = [
  { path: '/admin/users/register', component: Register },
  { path: '/admin/users/login', component: Login},
  { path: '/users/password-reset', component: PasswordReset},
  { path: '/admin/dashboard', component: Dashboard},
//   { path: '/about', component: About },
//   { path: '/contact', component: Contact },
  // Define more routes as needed
];

const router = new VueRouter({
  routes,
  mode: 'history', // Use history mode for clean URLs
});

export default router;
