<template>
    <div class="flex flex-col w-full gap-5 p-5 sm:gap-10 sm:pt-20 sm:p-10 lg:flex-row">
        <div class="flex flex-col w-full pt-10 lg:w-4/12">
          <span class="text-2xl font-semibold">Customer Reviews <span v-if="companyName">on</span>  {{ companyName }}</span>            
          <div class="flex flex-row items-center mt-4">
            <template v-for="index in 5" :key="index">
              <span :class="getStarClass(index)">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20">
                  <path v-if="index <= averageRating" class="text-yellow-300 fill-current" d="M10 1L12.78 6.71L18 7.8L14.47 11.79L15.65 17L10 14.25L4.35 17L5.53 11.79L2 7.8L7.22 6.71L10 1Z" />
                  <path v-else class="text-gray-300 fill-current" d="M10 1L12.78 6.71L18 7.8L14.47 11.79L15.65 17L10 14.25L4.35 17L5.53 11.79L2 7.8L7.22 6.71L10 1Z" />
                </svg>
              </span>
            </template>
            <div class="ml-2">
              <span class="text-sm text-gray-600">Based on {{ item.rating }} reviews</span>
            </div>
          </div>
            <div class="flex flex-row items-center gap-2 mt-4" v-for="item in calculatedReview" :key="item.id">
              <span class="text-sm ">{{ item.rating }}</span>
              <span class="text-yellow-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                  <path v-if="item.count > 0" d="M10 1L12.78 6.71L18 7.8L14.47 11.79L15.65 17L10 14.25L4.35 17L5.53 11.79L2 7.8L7.22 6.71L10 1Z" />
                  <path v-else class="text-gray-300" d="M10 1L12.78 6.71L18 7.8L14.47 11.79L15.65 17L10 14.25L4.35 17L5.53 11.79L2 7.8L7.22 6.71L10 1Z" />
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
        <div class="sm:w-1/12"></div>
        <div class="flex flex-col justify-center lg:w-7/12" >  
            <div class="w-auto pt-10 " v-for="item in reviewPost" :key="item.id" >
                <div class="flex flex-row items-center gap-4">
                <div class="w-12 h-12 overflow-hidden bg-gray-300 rounded-full">
                  <img :src="item.image" alt="">
                </div>
                <div class="flex flex-col">
                  <span class="mb-2 text-sm font-semibold">{{item.user.first_name + ' ' + item.user.last_name}}</span>
                  <div class="flex flex-row">
                    <template v-for="index in 5">
                      <span class="text-yellow-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20">
                          <path v-if="index <= item.rating" class="fill-current" d="M10 1L12.78 6.71L18 7.8L14.47 11.79L15.65 17L10 14.25L4.35 17L5.53 11.79L2 7.8L7.22 6.71L10 1Z" />
                          <path v-else d="M10 1L12.78 6.71L18 7.8L14.47 11.79L15.65 17L10 14.25L4.35 17L5.53 11.79L2 7.8L7.22 6.71L10 1Z" fill="#e2e8f0" />
                        </svg>
                      </span>
                    </template>
                  </div>
                </div>
              </div>
              <div class="mt-4">
                <span class="text-sm text-gray-500">{{ item.description }}</span>
              </div>
              <hr class="mt-10">
            </div>
        </div>
    </div>
</template>


<script setup>
import Company from "@/composables/Company"
import { computed, onMounted, ref } from "vue";
import { useRoute } from "vue-router";

const { companyReview } = Company()
const route = useRoute()
const id = ref(route.params.id)
const token = ref(localStorage.getItem('reviewAccessToken'))
const reviewPost = ref([])
const item = ref({
  rating: '' 
});
const companyName = ref('')

const getReview = () =>{
  companyReview(token.value, id.value).then((response)=>{
    reviewPost.value = response.data.reviews

    companyName.value = response.data.reviews[0]?.company.name 
    
    const ratingCount = response.data.reviews.length;
    item.value.rating = ratingCount

  });
}

const calculatedReview = computed(() => {
  const totalReviews = reviewPost.value.length;
  const starCount = [0, 0, 0, 0, 0];

  // Count the number of each star rating
  reviewPost.value.forEach((item) => {
    starCount[item.rating - 1]++;
  });

  // Calculate the percentage and store it along with the count for each star rating
  const starRatings = starCount.map((count, index) => ({
    rating: index + 1,
    count,
    percentage: ((count / totalReviews) * 100).toFixed(1),
  }));
  starRatings.sort((a, b) => b.rating - a.rating);

  if (totalReviews === 0) {
    starRatings.fill({ rating: 0, count: 0, percentage: "0.0" });
  }
  return starRatings;
});

// Function to get the average rating based on all the reviews
const averageRating = computed(() => {
  if (item.value.rating === 0) {
    return 0;
  }
  return Math.round(item.value.rating);
});

// Function to change the stars color according to the rating value coming from endpoint 
const getStarClass = (index) => {
  if (index <= item.value.rating) {
    return 'text-yellow-300';
  } else {
    return 'text-gray-300';
  }
};

onMounted(()=>{
  getReview()
})

</script>


