<template>
    <div class="flex flex-col w-full gap-5 p-5 sm:gap-10 sm:pt-20 sm:p-10 lg:flex-row">
        <div class="flex flex-col w-full pt-10 md:w-6/12">
            <span class="text-2xl font-semibold">Customer Reviews</span>
            
            <div class="flex flex-row items-center mt-4">
                  <span class="text-yellow-300 ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                      <path d="M10 1L12.78 6.71L18 7.8L14.47 11.79L15.65 17L10 14.25L4.35 17L5.53 11.79L2 7.8L7.22 6.71L10 1Z" />
                    </svg>
                  </span>
                  <span class="text-yellow-300 ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                      <path d="M10 1L12.78 6.71L18 7.8L14.47 11.79L15.65 17L10 14.25L4.35 17L5.53 11.79L2 7.8L7.22 6.71L10 1Z" />
                    </svg>
                  </span>
                  <span class="text-yellow-300 ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                      <path d="M10 1L12.78 6.71L18 7.8L14.47 11.79L15.65 17L10 14.25L4.35 17L5.53 11.79L2 7.8L7.22 6.71L10 1Z" />
                    </svg>
                  </span>
                  <span class="text-yellow-300 ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                      <path d="M10 1L12.78 6.71L18 7.8L14.47 11.79L15.65 17L10 14.25L4.35 17L5.53 11.79L2 7.8L7.22 6.71L10 1Z" />
                    </svg>
                  </span>
                  <span class="text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                      <path d="M10 1L12.78 6.71L18 7.8L14.47 11.79L15.65 17L10 14.25L4.35 17L5.53 11.79L2 7.8L7.22 6.71L10 1Z" />
                    </svg>
                  </span>
                  <div class="ml-2">
                    <span class="text-sm text-gray-600">Based on 1624 reviews</span>
                  </div>
              </div>
              <div class="flex flex-row items-center gap-2 mt-4" v-for="item in review" :key="item.id">
                <span class="text-sm ">{{ item.number }}</span>
                <span class="text-yellow-300 ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                      <path d="M10 1L12.78 6.71L18 7.8L14.47 11.79L15.65 17L10 14.25L4.35 17L5.53 11.79L2 7.8L7.22 6.71L10 1Z" />
                    </svg>
                  </span>
                  
                  <div class="flex flex-col w-full">
                     <div class="flex items-center">
                        <div class="w-full bg-gray-300 rounded-full">
                            <div :style="{ width: `${item.percentage}%` }" class="h-3 bg-yellow-300 rounded-full"></div>
                        </div>
                        <span class="ml-2 text-sm">{{ item.percentage }}%</span>
                    </div>
                 </div>
              </div>
              <div class="flex flex-col w-full mt-6">
                <span class="mb-2 text-base">Share your thoughts</span>
                <span class="mb-6 text-sm text-gray-500">if you've use this product, share your thoughts with other customers</span>
                <span class="p-2 text-sm text-center border rounded cursor-pointer hover:bg-gray-50">Write a review</span>
              </div>
        </div>
        <div class="sm:w-2/12"></div>
        <div class="flex flex-col justify-center" >  
            <div class="w-full pt-10 " v-for="item in reviewPost" :key="item.id" >
                <div class="flex flex-row items-center gap-4">
                <div class="w-12 h-12 overflow-hidden bg-gray-300 rounded-full">
                  <img :src="item.image" alt="">
                </div>
                <div class="flex flex-col">
                  <span class="mb-2 text-sm font-semibold">{{item.user}}</span>
                    <div class="flex flex-row">
                        <span class="text-yellow-300 ">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                <path d="M10 1L12.78 6.71L18 7.8L14.47 11.79L15.65 17L10 14.25L4.35 17L5.53 11.79L2 7.8L7.22 6.71L10 1Z" />
                            </svg>
                        </span>
                        <span class="text-yellow-300 ">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                <path d="M10 1L12.78 6.71L18 7.8L14.47 11.79L15.65 17L10 14.25L4.35 17L5.53 11.79L2 7.8L7.22 6.71L10 1Z" />
                            </svg>
                        </span>
                        <span class="text-yellow-300 ">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                              <path d="M10 1L12.78 6.71L18 7.8L14.47 11.79L15.65 17L10 14.25L4.35 17L5.53 11.79L2 7.8L7.22 6.71L10 1Z" />
                            </svg>
                        </span>
                        <span class="text-yellow-300 ">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                              <path d="M10 1L12.78 6.71L18 7.8L14.47 11.79L15.65 17L10 14.25L4.35 17L5.53 11.79L2 7.8L7.22 6.71L10 1Z" />
                            </svg>
                        </span>
                    </div>
                </div>
              </div>
              <div class="mt-4">
                <span class="text-sm text-gray-500">{{ item.para }}</span>
              </div>
              <hr class="mt-10">
            </div>
        </div>
    </div>
</template>


<script setup>
import { ref } from "vue";



const review = ref([
    { id:'1', percentage:'63', number:'5' },
  { id:'2', percentage:'10', number:'4'},
  { id:'3', percentage:'6', number:'3'},
  { id:'4', percentage:'12', number:'2' },
  { id:'4', percentage:'50', number:'1' },
])


const reviewPost = ref([
{ id:'1', image:'https://images.unsplash.com/photo-1502685104226-ee32379fefbe?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=256&h=256&q=80', para:'This is the bag of my dreams. I took it on my last vacation and was able to fit an absurd amount of snacks for the many long and hungry flights.', user:'Emily Selman', time:'12:30 PM' },
  { id:'2',image:'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=256&h=256&q=80', para:'Before getting the Ruck Snack, I struggled my whole life with pulverized snacks, endless crumbs, and other heartbreaking snack catastrophes. Now, I can stow my snacks with confidence and style!', user:'Hector Gibbons', time:'11:00 PM'},
  { id:'3',image:'https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-1.2.1&ixqx=oilqXxSqey&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80', para:' love how versatile this bag is. It can hold anything ranging from cookies that come in trays to cookies that come in tins.', user:'Mark Edwards', time:'2:00 PM'},
])

</script>


