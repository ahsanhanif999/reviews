
<template>

  <SiteLayout v-if="route.meta.isUserRoute == true">
    <router-view />
  </SiteLayout>

  
</template>

<script setup>
import SiteLayout from '@/layout/SiteLayout.vue';
import { useRoute } from "vue-router"

const route = useRoute()


</script>

