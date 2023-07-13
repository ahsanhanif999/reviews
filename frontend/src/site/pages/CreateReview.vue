<template>
    <div class="flex flex-col w-full px-5 md:px-10">
        <div class="py-4 font-medium">
            Create a review
        </div>
        <div class="flex flex-col w-full p-4 border md:gap-8 md:p-8 md:flex-row bg-gray-50 rounded-xl">
            <div class="w-full my-8 md:w-3/6">
                <div class="flex flex-col ">
                    <span class="text-lg font-medium">How would you like to give your review</span>
                    <div class="flex flex-row gap-4 mt-4">
                        <div class="flex flex-col w-full p-3 bg-white border-2 cursor-pointer md:p-6 rounded-xl hover:border-indigo-500"
                            ref="div1"
                            :class="{ 'border-indigo-500': activeDiv == 1 }"
                            @click="toggleActive(1)">
                            <span class="text-sm">Write</span>
                            <span class="text-sm text-gray-500">Describe your thoughts in text</span>
                            
                        </div>
                        <div class="flex flex-col w-full p-3 bg-white border-2 cursor-pointer md:p-6 rounded-xl hover:border-indigo-500 "
                            ref="div2"
                            :class="{ 'border-indigo-500': activeDiv == 2 }"
                            @click="toggleActive(2)">
                            <span class="text-sm">Record</span>
                            <span class="text-sm text-gray-500">Describe your review in audio recording</span>
                        </div>
                    </div>
                </div>
            
                <div class="flex flex-col mt-8">
                    <div class="flex flex-col text-gray-700">
                        <label  class="mb-1 text-sm">Summary</label>
                        <input type="text" v-model="summary" class="p-2 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600"/>
                    </div>
                    <Combobox as="div" class="flex flex-row gap-2 mt-6" v-model="selectedCompany">
                        <div class="flex flex-col w-3/6">
                            <ComboboxLabel class="text-sm text-gray-700">Choose Company</ComboboxLabel>
                            <div class="relative mt-1">                                
                                <ComboboxInput class="w-full p-2 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600" @change="query = $event.target.value" :display-value="(company) => company?.name"/>
                                <ComboboxButton class="absolute inset-y-0 right-0 flex items-center px-2 rounded-r-md focus:outline-none">
                                    <ChevronUpDownIcon class="w-5 h-5 text-gray-400" aria-hidden="true" />
                                </ComboboxButton>
                                <ComboboxOptions v-if="filteredCompany.length > 0" class="absolute z-10 w-full py-1 mt-1 overflow-auto text-base bg-white rounded-md shadow-lg max-h-60 ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                                    <ComboboxOption v-for="company in filteredCompany" :key="company.id" :value="company" as="template" v-slot="{ active, selected }">
                                        <li :class="['relative cursor-default select-none py-2 pl-3 pr-9', active ? 'bg-indigo-600 text-white' : 'text-gray-900']">
                                            <div class="flex flex-row gap-2">
                                              <img :src="(`/assets/images/${company.logo}`)" class="w-6 h-6 rounded-full" alt="">
                                              <span :class="['block truncate', selected && 'font-semibold']">
                                                  {{ company.name }}
                                              </span>
                                            </div>
                                            <span v-if="selected" :class="['absolute inset-y-0 right-0 flex items-center pr-4', active ? 'text-white' : 'text-indigo-600']">
                                                <CheckIcon class="w-5 h-5" aria-hidden="true" />
                                            </span>
                                        </li>
                                    </ComboboxOption>
                                    <ComboboxOption value="Other" as="template" v-slot="{ active }">
                                        <li :class="['relative cursor-default select-none py-2 pl-3 pr-9', active ? 'bg-indigo-600 text-white' : 'text-gray-900']">
                                            <span :class="['block truncate', active ? 'font-semibold' : '']">
                                                Other
                                            </span>
                                        </li>
                                    </ComboboxOption>
                                </ComboboxOptions>
                            </div>
                        </div>

                        <div class="w-3/6" >
                            <label class="mb-1 text-sm text-gray-700" for="">Enter Company</label>
                            <input type="text" v-model="customCountry" class="w-full p-2 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600" :disabled="selectedCompany !== 'Other'">
                        </div>
                    </Combobox>
                    
                    <!-- Combobox for user to select tags -->
                    <Combobox as="div" class="flex flex-row gap-2 mt-6" v-model="selectedTag" :open.sync="tagDropdownOpen" multiple>
                      <div class="flex flex-col w-3/6">
                        <ComboboxLabel class="text-sm text-gray-700">Choose Tag</ComboboxLabel>
                        <div class="relative mt-1">
                          <ComboboxInput class="w-full p-2 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600" @change="tagquery = $event.target.value" :display-value="(tag) => tag?.name" />
                          <ComboboxButton class="absolute inset-y-0 right-0 flex items-center px-2 rounded-r-md focus:outline-none">
                            <ChevronUpDownIcon class="w-5 h-5 text-gray-400" aria-hidden="true" />
                          </ComboboxButton>
                          <ComboboxOptions v-if="filteredTag.length > 0" class="absolute z-10 w-full py-1 mt-1 overflow-auto text-base bg-white rounded-md shadow-lg max-h-60 ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                            <ComboboxOption v-for="tag in filteredTag" :key="tag.id" :value="tag" as="template" v-slot="{ active, selected }">
                              <li :class="['relative cursor-default select-none py-2 pl-3 pr-9', active ? 'bg-indigo-600 text-white' : 'text-gray-900']">
                                <span :class="['block truncate', selected && 'font-semibold']"  @click="closeDropdown">
                                  {{ tag.name }}
                                </span>
                                <span v-if="selected" :class="['absolute inset-y-0 right-0 flex items-center pr-4', active ? 'text-white' : 'text-indigo-600']">
                                  <CheckIcon class="w-5 h-5" aria-hidden="true" />
                                </span>
                              </li>
                            </ComboboxOption>
                          </ComboboxOptions>
                        </div>
                      </div>

                      <div class="w-3/6">
                        <label class="mb-1 text-sm text-gray-700" for="">Add New Tag</label>
                        <div class="flex flex-row gap-1">
                          <input type="text" v-model="customTag"  class="w-full p-2 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600"  @blur="updateSelectedTags" />
                          <span class="flex items-center p-2 px-4 bg-green-600 border rounded-lg cursor-pointer hover:bg-green-500" @click="updateSelectedTags">
                            <svg class="w-4 h-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                              <path d="M20 6L9 17l-5-5" />
                            </svg>
                          </span>
                        </div>
                      </div>
                    </Combobox>
                    <div class="flex flex-col mt-4">
                      <span class="text-sm text-gray-700">Selected Tags:</span>
                      <div class="flex flex-wrap mt-1">
                        <span v-for="tag in selectedTag" :key="tag.id" class="inline-flex items-center px-2 py-1 mt-2 mr-2 text-xs font-medium text-gray-600 rounded-full bg-gray-50 ring-1 ring-inset ring-gray-500/10">
                          {{ tag.name }}
                          <button type="button" class="ml-2 text-indigo-600" @click="removeTag(tag)">
                            <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                              <path fill-rule="evenodd" d="M14.707 5.293a1 1 0 0 0-1.414 0L10 8.586 6.707 5.293a1 1 0 0 0-1.414 1.414L8.586 10l-3.293 3.293a1 1 0 0 0 1.414 1.414L10 11.414l3.293 3.293a1 1 0 0 0 1.414-1.414L11.414 10l3.293-3.293a1 1 0 0 0 0-1.414z" clip-rule="evenodd" />
                            </svg>
                          </button>
                        </span>
                      </div>
                    </div>
                    <div class="flex flex-col w-full mt-8">
                      <label class="text-sm text-gray-600">Add file:</label>
                      <div class="flex flex-col w-full gap-2">
                        <label v-if="fileInputText" for="fileInput" class="w-full px-4 py-2 mt-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm cursor-pointer hover:border-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                          {{ fileInputText }}
                        </label>
                        <input id="fileInput" type="file" multiple @change="handleFileUpload" class="hidden">
                        <button @click="uploadImages" class="w-full p-2 mt-2 text-sm leading-4 text-white bg-indigo-500 rounded-md shadow-sm hover:bg-indigo-400">
                          Upload
                        </button>
                      </div>
                      <div v-for="image in uploadedImages" :key="image.id">
                        <img :src="image.url" alt="Uploaded Image">
                      </div>
                    </div>
                    
                </div>
                <div class="flex flex-col md:my-8">
                    <div>
                        <span class="text-lg">Your rating</span>
                    </div>
                    <div class="flex flex-row mt-2">
                        <div v-for="(star, index) in stars" :key="index" class="p-2 border" :class="{ 'bg-yellow-600': star.filled || star.highlighted }" @mouseover="highlightStars(index)" @mouseout="resetStars" @click="toggleFill(index)">
                            <span class="text-yellow-300">
                                <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5 fill-current"
                                viewBox="0 0 20 20"
                                >
                                <path
                                    d="M10 1L12.78 6.71L18 7.8L14.47 11.79L15.65 17L10 14.25L4.35 17L5.53 11.79L2 7.8L7.22 6.71L10 1Z"
                                    :fill="star.filled || star.highlighted ? 'currentColor' : ''"
                                />
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col w-full" v-if="activeDiv === 1">
                    <div class="mb-2">
                        <span class="text-lg">Provide details of your experience</span>
                    </div>
                    <div class="w-full" >
                        <textarea v-model="experience" class="w-full p-2 text-sm border rounded focus:outline-none focus:ring-2 focus:ring-indigo-600" rows="4"></textarea>
                    </div>
                </div>
                <div class="flex justify-center w-full my-6">
                    <span class="w-full p-2 text-center text-white bg-indigo-600 rounded cursor-pointer hover:bg-indigo-500">Post Review</span>
                </div>
            </div>
            <div class="w-full my-4 md:my-8 md:w-3/6 ">
                <Preview @response="userId"  :filledCount="filledCount" :customCountry="customCountry" :selectedTag="selectedTag" :customTag="customTag" :selectedCompany="selectedCompany"  :activeDiv="activeDiv" :experience="experience" :summary="summary"/>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Combobox, ComboboxButton, ComboboxInput, ComboboxLabel, ComboboxOption, ComboboxOptions,} from '@headlessui/vue'
import { CheckIcon, ChevronUpDownIcon } from '@heroicons/vue/20/solid'
import Preview from "@/site/components/createReview/Preview.vue"
import { onMounted, ref } from 'vue'
import { computed } from 'vue'
import { useStore } from 'vuex';

const uploadedImages = ref([]);
const selectedFiles = ref([]);
const fileInputText = ref('Choose File');

const handleFileUpload = (event) => {
  selectedFiles.value = Array.from(event.target.files);
  fileInputText.value = selectedFiles.value.map(file => file.name).join(', ');
};

const uploadImages = () => {
  const formData = new FormData();
  selectedFiles.value.forEach((file) => {
    formData.append('images[]', file);
  });
}

const store = useStore()
const token = ref(localStorage.getItem('reviewAccessToken'))
const tagDropdownOpen = ref(false)
const selectedCompany = ref('')
const customCountry = ref('')
const selectedTag = ref([])
const filledCount = ref(0)
const experience = ref('')
const customTag = ref('')
const tagquery = ref('')
const activeDiv = ref(1)
const summary = ref('')
const div1 = ref(null)
const div2 = ref(null)
const query = ref('')
const company = ref([])
const tag = ref([])
const loginUserId = ref('')

const userId = (data) =>{
  loginUserId.value = data
}

const stars = ref([
  { filled: false, highlighted: false },
  { filled: false, highlighted: false },
  { filled: false, highlighted: false },
  { filled: false, highlighted: false },
  { filled: false, highlighted: false },
]);

store.dispatch('getCompany', token.value)
  .then((response) => {
    company.value = response.data.companies
  })
  .catch((error) => {
    console.log(error)
  });

  
const filteredCompany = computed(() =>
query.value === ''
? company.value
: company.value.filter((company) => {
  return company.name.toLowerCase().includes(query.value.toLowerCase())
})
)

const getTag = () => { 
store.dispatch('getTagList', token.value)
  .then((response) => {
    tag.value = response.data.tags
  })
  .catch((error) => {
    console.log(error)
  });
}

// For tags dropdown
const filteredTag = computed(() =>
  tagquery.value === ''
    ? tag.value
    : tag.value.filter((tag) => {
        return tag.name.toLowerCase().includes(tagquery.value.toLowerCase())
      })
)

const closeDropdown = () => {
  tagDropdownOpen.value = false;
};

const updateSelectedTags = () => {
  if (customTag.value !== '') {
  let tagData = {
    name : customTag.value,
    created_by : loginUserId.value
  }
  store.dispatch('createTag',{ token: token.value, tagData })
  .then((response) => {
    console.log(response)
    if(response.status === 201){
      getTag()
    }
    })
  .catch((error) => {
    console.log(error)
    });
  }
  if (customTag.value.trim() !== '') {
    selectedTag.value.push({ id: selectedTag.value.length + 1, name: customTag.value.trim() });
    customTag.value = ''
  } 
}

function removeTag(tag) {
  const index = selectedTag.value.indexOf(tag);
  if (index !== -1) {
    selectedTag.value = [...selectedTag.value.slice(0, index), ...selectedTag.value.slice(index + 1)];
  }
}

const highlightStars = (index) => {
  for (let i = 0; i <= index; i++) {
    stars.value[i].highlighted = true;
  }
};

const resetStars = () => {
  for (let i = 0; i < stars.value.length; i++) {
    stars.value[i].highlighted = false;
  }
};

const toggleFill = (index) => {
  for (let i = 0; i < stars.value.length; i++) {
    if (i <= index) {
      stars.value[i].filled = true;
    } else {
      stars.value[i].filled = false;
    }
  }

  filledCount.value = stars.value.filter((star) => star.filled).length;
};

function toggleActive(id) {
  activeDiv.value = id;
}

function handleClickOutside(event) {
  if (event.target !== div1.value && event.target !== div2.value) {
  }
}

onMounted(() => {
  document.addEventListener('click', handleClickOutside);
  getTag()
});


</script>
