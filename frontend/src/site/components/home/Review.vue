<template>
    <div class="py-10">
        <div class="flex items-center justify-between px-5 sm:px-10 ">
            <span class="font-bold sm:text-xl">Shop By Category</span>
            <span class="text-xs font-semibold text-indigo-600 cursor-pointer sm:text-sm hover:text-indigo-400">Browse all Category </span>
        </div>
        <div class="flex flex-col gap-8 px-10 mt-4 rounded-lg sm:flex-row">
            <div class="relative w-full rounded-lg sm:w-1/5" v-for="img in displayedImages" :key="img.id" >
                <RouterLink :to="{ name: 'CompanyReview', params: { id: img.id } }" @click="scrollToTop">
                    <div class="relative">
                        <img :src="(`/assets/images/${img.logo}`)" class="w-full h-full rounded-lg" alt="">
                        <div class="absolute bottom-0 left-0 right-0 rounded-b-lg h-2/3 bg-gradient-to-t from-gray-500 via-transparent to-transparent"></div>
                    </div>
                    <span class="absolute bottom-0 left-0 right-0 flex items-center justify-center my-4 font-bold text-white sm:text-lg">{{ img.name }}</span>
                </RouterLink>
                </div>
            </div>
    </div>
</template>

<script setup>
import { computed, onMounted, ref } from "vue";
import { RouterLink } from "vue-router";
import { useStore } from "vuex"

const store = useStore()
const token = ref(localStorage.getItem('reviewAccessToken'))

const images = ref([])
const displayedImages = computed(() => images.value.slice(0, 6));

const scrollToTop = () => {
  window.scrollTo({
    top: 0,
    behavior: 'smooth',
  });
};

onMounted(()=>{
    store.dispatch('getCompany', token.value)
  .then((response) => {
    images.value = response.data.companies
  })
  .catch((error) => {
    console.log(error)
  });
})

</script>










