
<template>

<div>
  <SiteLayout v-if="route.meta.isUserRoute == true">
    <router-view />
  </SiteLayout>
  
  <AdminLayout v-if="route.meta.isAdminRoute == true">
    <router-view/>
  </AdminLayout>
  
</div>

  
</template>

<script setup>
import SiteLayout from '@/layout/SiteLayout.vue';
import AdminLayout from '@/layout/AdminLayout.vue';
import { useRoute } from "vue-router"


const route = useRoute()


</script>

