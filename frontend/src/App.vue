
<template>

<div>  
  <SiteLayout v-if="route.meta.isUserRoute == true">
    <router-view />
  </SiteLayout>
  
  <AdminLayout v-if="route.meta.isAdminRoute == true">
    <router-view/>
  </AdminLayout>

  <Register v-else-if="$route.name == 'Register'">
    <router-view/>
  </Register>

  <Login v-else-if="$route.name == 'Login'">
    <router-view/>
  </Login>
</div>

  
</template>

<script setup>
import SiteLayout from '@/layout/SiteLayout.vue';
import AdminLayout from '@/layout/AdminLayout.vue';
import Login from '@/site/pages/Login.vue';
import Register from '@/site/pages/Register.vue';
import { useRoute } from "vue-router"


const route = useRoute()


</script>

