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
              <span >{{ item.user.first_name + ' ' + item.user.last_name }}</span>
              <span class="text-sm text-gray-500">{{ item.company.created_at }}</span>
            </div>
          </div>
            <div class="flex flex-col ml-12">
              <div class="flex flex-row">
                <template v-for="index in 5">
                  <span :class="getStarClass(index)" class="mt-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20">
                      <path v-if="index <= item.rating" class="text-yellow-300 fill-current" d="M10 1L12.78 6.71L18 7.8L14.47 11.79L15.65 17L10 14.25L4.35 17L5.53 11.79L2 7.8L7.22 6.71L10 1Z" />
                      <path v-else class="text-gray-300 fill-current" d="M10 1L12.78 6.71L18 7.8L14.47 11.79L15.65 17L10 14.25L4.35 17L5.53 11.79L2 7.8L7.22 6.71L10 1Z" />
                    </svg>
                  </span>
                </template>
              </div>
              <div class="mt-4">{{ item.title }}</div>
              <span class="mt-2 text-sm text-gray-500">
                {{ item.description }}
              </span>
              <div class="flex flex-row gap-4 my-4">
                <span v-for="tag in item.tags" :key="tag.id" class="inline-flex items-center px-2 py-1 text-xs font-medium text-gray-600 rounded-full bg-gray-50 ring-1 ring-inset ring-gray-500/10">{{ tag.name }}</span>
              </div>
              <div class="text-sm"><span class="text-sm text-gray-700">Company: </span>{{ item.company.name }}</div>
              <hr class="mt-4">
            </div>
          </div>
        </div>
        <div class="sm:w-2/6"></div>
      </div>
    </div>
  </template>

<script setup>
import Company from "@/composables/Post"
import { onMounted, ref } from "vue";

const { postList } = Company()
const details = ref([])
const token = ref(localStorage.getItem('reviewAccessToken'))
const item = ref({
  rating : ''
})

const getPost = () => {
  postList(token.value).then((response)=>{
    details.value = response.data.posts
    const ratingCount = response.data.posts.length;
    item.value.rating = ratingCount
  })
}

const getStarClass = (index) => {
  if (index <= item.value.rating) {
    return 'text-yellow-300';
  } else {
    return 'text-gray-300';
  }
};

onMounted(()=>{
  getPost()
})

</script>