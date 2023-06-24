import { createRouter, createWebHistory } from 'vue-router'
import Home from '@/site/pages/Home.vue'
import ReviewList from '@/site/pages/ReviewList.vue'
import CompanyReview from '@/site/pages/CompanyReview.vue'
import CreateReview from '@/site/pages/CreateReview.vue'

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home,
    meta: { isUserRoute: true },
  },

  {
    path: '/reviews/list',
    name: 'ReviewList',
    component: ReviewList,
    meta: { isUserRoute: true },
  },

  {
    path: '/reviews/company',
    name: 'CompanyReview',
    component: CompanyReview,
    meta: { isUserRoute: true },
  },

  {
    path: '/reviews/create',
    name: 'CreateReview',
    component: CreateReview,
    meta: { isUserRoute: true },
  },
  
]


const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router;
