<template>
    <div class="flex flex-col w-full px-4 py-2 sm:px-8">
      <div class="flex justify-center">
        <div class="sm:w-2/6"></div>
        <div class="">
          <div class="flex flex-col pt-12 " v-for="item in details" :key="item.id">
          <div class="flex flex-row items-center gap-2">
            <div class="w-10 h-10 overflow-hidden bg-gray-300 rounded-full">
              <img src="/assets/images/default_profile.png" alt="">
            </div>
            <div class="flex flex-col">
              <span >{{ item.user }}</span>
              <span class="text-sm text-gray-500">{{ item.date }}</span>
            </div>
          </div>
            <div class="flex flex-col ml-12">
              <div class="flex flex-row">
                  <span class="mt-4 text-yellow-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                      <path d="M10 1L12.78 6.71L18 7.8L14.47 11.79L15.65 17L10 14.25L4.35 17L5.53 11.79L2 7.8L7.22 6.71L10 1Z" />
                    </svg>
                  </span>
                  <span class="mt-4 text-yellow-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                      <path d="M10 1L12.78 6.71L18 7.8L14.47 11.79L15.65 17L10 14.25L4.35 17L5.53 11.79L2 7.8L7.22 6.71L10 1Z" />
                    </svg>
                  </span>
                  <span class="mt-4 text-yellow-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                      <path d="M10 1L12.78 6.71L18 7.8L14.47 11.79L15.65 17L10 14.25L4.35 17L5.53 11.79L2 7.8L7.22 6.71L10 1Z" />
                    </svg>
                  </span>
              </div>
              <div class="mt-4">{{ item.title }}</div>
              <span class="mt-2 text-sm text-gray-500">
                {{ item.para }}
              </span>
              <div class="flex flex-row gap-4 my-4">
                <span v-for="tag in item.tags" :key="tag.id" class="inline-flex items-center px-2 py-1 text-xs font-medium text-gray-600 rounded-full bg-gray-50 ring-1 ring-inset ring-gray-500/10">{{ tag.name }}</span>
              </div>
              <div class="text-sm"><span class="text-sm text-gray-700">Company: </span>{{ item.company }}</div>
              <hr class="mt-4">
            </div>
          </div>
        </div>
        <div class="sm:w-2/6"></div>
      </div>
    </div>
  </template>

<script setup>
import { ref } from "vue";


const details = ref([
  { 
    id:'1',
    para: 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here',
    title:'Setting the scene for the review, emphasizing the importance of a good cup of coffee', 
    date:'17/6/2023 ', 
    user:'John', 
    img:'/assets/images/default_profile.png', 
    company:'KFC',
    tags: [
     { id: 1, name: 'Tag1' },
     { id: 2, name: 'Tag2' },
     { id: 3, name: 'Tag3' },
    ]
  },

  { 
    id:'2', para: 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don look even slightly believable',
    title:'Discussing the different brewing methods such as pour-over, French press', 
    date:'7/6/2022', 
    user:'William', 
    img:'/assets/images/default_profile.png',
    company:'J.',
    tags: [
     { id: 4, name: 'Tag4' },
     { id: 5, name: 'Tag5' },
     { id: 6, name: 'Tag6' },
    ]
  },

  { 
    id:'3', 
    para: 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old',
    title:'Delving into the nuances of taste and aroma, describing the richness, acidity', 
    date:'8/7/2023', 
    user:'Stairis', 
    img:'/assets/images/default_profile.png',
    company:'MTJ',
    tags: [
     { id: 7, name: 'Tag7' },
     { id: 8, name: 'Tag8' },
     { id: 9, name: 'Tag9' },
    ]
  },

  { id:'4', 
  para: 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don look even slightly believable',
  title:'Summarizing the entire coffee-drinking experience, from the enticing aroma', 
  date:'9/4/2023', 
  user:'Henry', 
  img:'/assets/images/default_profile.png' ,
  company:'Borjan',
  tags: [
     { id: 10, name: 'Tag10' },
     { id: 11, name: 'Tag11' },
     { id: 12, name: 'Tag12' },
    ]
},
])

</script>