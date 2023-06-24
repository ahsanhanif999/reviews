import { createRouter, createWebHistory } from 'vue-router'
import Home from '@/site/pages/Home.vue'
import ReviewList from '@/site/pages/ReviewList.vue'

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home,
    meta: { isUserRoute: true },
  },
  {
    path: '/review-list',
    name: 'ReviewList',
    component: ReviewList,
    meta: { isUserRoute: true },
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router;
