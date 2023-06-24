<template>
    <div>
        <Header></Header>
        <div>
            <slot></slot>
            
        </div>
        <Footer></Footer>
    </div>
</template>

<script setup>
import Header from '@/site/components/Header.vue';
import Footer from '@/site/components/Footer.vue';
</script>
