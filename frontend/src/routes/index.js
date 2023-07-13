import { createRouter, createWebHistory } from 'vue-router'
import Home from '@/site/pages/Home.vue'
import ReviewList from '@/site/pages/ReviewList.vue'
import CompanyReview from '@/site/pages/CompanyReview.vue'
import CreateReview from '@/site/pages/CreateReview.vue'
import Login from "@/site/pages/Login.vue"
import Register from "@/site/pages/Register.vue"
import { computed, ref } from 'vue'

const token = ref(localStorage.getItem('reviewAccessToken'))
const Authenticated = computed(() => token.value !== null && token.value != '')

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home,
    meta: { requiresAuth: true, isUserRoute: true },
  },
  {
    path: '/login',
    name: 'Login',
    component: Login,
    meta: { requiresAuth: false, isUserRoute: false },
  },
  {
    path: '/register',
    name: 'Register',
    component: Register,
    meta: { requiresAuth: false, isUserRoute: false },
  },
  {
    path: '/reviews/list',
    name: 'ReviewList',
    component: ReviewList,
    meta: { requiresAuth: true, isUserRoute: true },
  },
  {
    path: '/reviews/company/:id',
    name: 'CompanyReview',
    component: CompanyReview,
    meta: { requiresAuth: true, isUserRoute: true },
  },
  {
    path: '/reviews/create',
    name: 'CreateReview',
    component: CreateReview,
    meta: { requiresAuth: true, isUserRoute: true },
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

router.beforeEach((to, from, next) => {
  const requiresAuth = to.meta.requiresAuth;
  const authenticated = Authenticated.value;

 if (!requiresAuth && authenticated && (to.name == 'Login' || to.name == 'Register')) {
    next({ name: 'Home' });
  }else if(requiresAuth && !authenticated && (to.name == 'ReviewList' || to.name == 'CompanyReview' || to.name == 'CreateReview')){
    next({name:'Home'})
  }
  else {
    next();
  }
})

export default router;



