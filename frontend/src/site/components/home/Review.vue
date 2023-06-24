<template>
    <div class="py-10">
        <div class="flex items-center justify-between px-5 sm:px-10 ">
            <span class="font-bold sm:text-xl">Shop By Category</span>
            <span class="text-xs font-semibold text-indigo-600 cursor-pointer sm:text-sm hover:text-indigo-400">Browse all Category </span>
        </div>
        <a href="#">
            <div class="flex flex-col gap-8 px-10 mt-4 rounded-lg sm:flex-row">
                <div class="relative w-full rounded-lg sm:w-1/5" v-for="img in images" :key="img.id">
                    <div class="relative">
                        <img :src="img.href" class="w-full h-full rounded-lg" alt="">
                        <div class="absolute bottom-0 left-0 right-0 rounded-b-lg h-2/3 bg-gradient-to-t from-gray-500 via-transparent to-transparent"></div>
                    </div>
                    <span class="absolute bottom-0 left-0 right-0 flex items-center justify-center my-4 font-bold text-white sm:text-lg">{{ img.name }}</span>
                </div>
            </div>
        </a>
    </div>
</template>

<script setup>
import { ref } from "vue";


const images = ref([
    { id:'1', name: 'Sale', href: 'https://tailwindui.com/img/ecommerce-images/home-page-01-category-01.jpg' },
  { id:'2', name: 'New Arrivals', href: 'https://tailwindui.com/img/ecommerce-images/home-page-01-category-02.jpg'},
  { id:'3', name: 'Accessories', href: 'https://tailwindui.com/img/ecommerce-images/home-page-01-category-03.jpg' },
  { id:'4', name: 'Productivity', href: 'https://tailwindui.com/img/ecommerce-images/home-page-01-category-04.jpg' },
  { id:'5', name: 'Workspace', href: 'https://tailwindui.com/img/ecommerce-images/home-page-01-category-05.jpg' },
])

</script>










