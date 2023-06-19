<template>
  <div>
    <div class="relative">
    <img src="https://tailwindui.com/img/ecommerce-images/home-page-01-hero-full-width.jpg" class="w-full h-auto " alt="">
    <div class="absolute inset-0 flex flex-col items-center justify-center bg-black bg-opacity-50">
      <div class="relative flex flex-col text-center">
        <span class="text-3xl font-bold text-white sm:text-7xl">New Arrivals are here</span>
        <span class="mt-2 text-sm font-medium text-white whitespace-normal sm:text-lg line-clamp-2">The new arrivals have well, newly arrived. Check out the latest options from our <br> summer small-batch release while they are still in stock</span>
      </div>
      <span class="p-2 px-3 mt-4 text-xs font-medium text-gray-700 bg-white border rounded-lg cursor-pointer sm:p-3 sm:px-6 hover:bg-gray-200">Shop New Arrivals</span>
    </div>
  </div>

    <Review/>  


    <div class="p-10 rounded-xl">
  <div class="relative w-full h-auto">
    <img src="https://tailwindui.com/img/ecommerce-images/home-page-01-feature-section-01.jpg" class="object-cover w-full max-h-96 rounded-xl" alt="">
    <div class="absolute inset-0 flex flex-col items-center justify-center bg-black bg-opacity-50 rounded-xl">
      <div class="flex flex-col text-center">
        <span class="text-2xl font-bold text-white sm:text-4xl">Level Up your Desk</span>
        <span class="px-4 mt-2 text-xs font-medium text-white whitespace-normal sm:px-0 sm:text-lg line-clamp-2 ">Make your desk beautiful and organized. Post a picture to social media and <br>  watch it get more likes than life-changing announcements. Reflect on the <br> shallow nature of existence. At least you have a really nice desk setup.</span>
      </div>
      <span class="p-2 px-3 mt-4 text-xs font-medium text-gray-700 bg-white border rounded-lg cursor-pointer sm:p-3 sm:px-6 hover:bg-gray-200">Shop Workspace</span>
    </div>
  </div>
</div>


    <div class="p-10">
      <div class="flex flex-col sm:justify-between sm:flex-row" >
        <div class="flex flex-col " v-for="item in data" :key="item.id">
          <div class="flex flex-row gap-2 pt-8 sm:pt-0">
            <span class="mb-2 text-sm text-gray-500">{{item.date}}</span>
            <span class="mb-2 text-sm text-gray-500">{{ item.time }}</span>
          </div>
          <span class="mb-2 font-bold">{{ item.name }}</span>
          <div class="flex flex-row items-center gap-2">
            <div class="w-10 h-10 overflow-hidden bg-gray-300 rounded-full">
              <img src="/assets/images/default_profile.png" alt="">
            </div>
            <span class="">{{ item.user }}</span>
          </div>

          <div class="flex flex-row items-center mt-4" >
            <span class="text-yellow-500">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                <path d="M10 1L12.78 6.71L18 7.8L14.47 11.79L15.65 17L10 14.25L4.35 17L5.53 11.79L2 7.8L7.22 6.71L10 1Z" />
              </svg>
            </span>
            <span class="text-yellow-500">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                <path d="M10 1L12.78 6.71L18 7.8L14.47 11.79L15.65 17L10 14.25L4.35 17L5.53 11.79L2 7.8L7.22 6.71L10 1Z" />
              </svg>
            </span>
            <span class="text-yellow-500">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                <path d="M10 1L12.78 6.71L18 7.8L14.47 11.79L15.65 17L10 14.25L4.35 17L5.53 11.79L2 7.8L7.22 6.71L10 1Z" />
              </svg>
            </span>
            <span class="text-yellow-500">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                <path d="M10 1L12.78 6.71L18 7.8L14.47 11.79L15.65 17L10 14.25L4.35 17L5.53 11.79L2 7.8L7.22 6.71L10 1Z" />
              </svg>
            </span>
          </div>
         
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import Review from '@/site/components/Review.vue';
import { ref } from 'vue';

const data = ref([
    { id:'1', name: 'Machined Pen', date:'17/6/2023 ', user:'John', time:'12:30 PM' },
  { id:'2', name: 'Earthen Mug', date:'7/6/2022', user:'William', time:'11:00 PM'},
  { id:'3', name: 'Leather Bound', date:'8/7/2023', user:'Stairis', time:'2:00 PM'},
  { id:'4', name: 'Leather Bound Journal', date:'9/4/2023', user:'Henry', time:'9:00 AM' },
])


</script>