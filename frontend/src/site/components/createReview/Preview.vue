<template>
    <div>
        <div>
            <span class="text-lg font-medium">
                This is how your review will show to others
            </span>
        </div>
        <div class="p-4 mt-4 bg-white rounded-xl">
            <div class="flex flex-row items-center gap-2">
            <div class="w-10 h-10 overflow-hidden bg-gray-300 rounded-full">
              <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=256&h=256&q=80" alt="">
            </div>
            <div class="flex flex-col">
              <span class="">John Doe</span>
              <span class="text-sm text-gray-500">26, July 2023</span>
            </div>
          </div>
            <div class="flex flex-col ml-12">
                <div class="flex flex-row">
                    <span v-for="(star, index) in 5" :key="index" class="mt-4" :class="starClass(index)">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                            <path d="M10 1L12.78 6.71L18 7.8L14.47 11.79L15.65 17L10 14.25L4.35 17L5.53 11.79L2 7.8L7.22 6.71L10 1Z" />
                        </svg>
                    </span>
                </div>
                <!-- If user want to write Text -->
                <div v-if="props.activeDiv == 1" >
                    <div class="mt-4">{{ props.summary }}</div>
                    <pre style="word-wrap: break-word; white-space: pre-wrap;" class="mt-2 text-sm text-gray-500">{{ formattedText }}</pre>
                    <div class="my-4">
                      <span v-for="tag in selectedTag" :key="tag.id" class="inline-flex items-center px-2 py-1 mt-2 mr-2 text-xs font-medium text-gray-600 rounded-full bg-gray-50 ring-1 ring-inset ring-gray-500/10">{{ tag.name }}</span>
                    </div>
                    <div class="flex flex-row my-4">
                        <div class="text-sm"><span class="mr-1 text-sm text-gray-700">Company: </span>{{ selectedCompanyValue.name }}</div>
                        <div v-if="selectedCompany == 'Other'" class="ml-1 text-sm">{{ props.customCountry }}</div>
                    </div>
                </div>

                <!-- Recording User Audio -->
                <div v-else class="my-10">
                    <div class="flex flex-col items-center">
                        <button v-if="!recording" @click="startRecording" class="px-4 py-2 text-white bg-indigo-600 rounded-md focus:outline-none">
                            Start Recording
                        </button>
                        <button v-else @click="stopRecording" class="px-4 py-2 text-white bg-red-500 rounded-md focus:outline-none">
                            Stop Recording
                        </button>
                        <p v-if="recording" class="text-gray-500">Recording your review...</p>
                        <audio ref="audioPlayer" controls v-if="audioBlob">
                            <source :src="audioBlobUrl" type="audio/wav">
                        </audio>
                    </div>
                </div>
                <hr class="mt-4">
                <div class="flex justify-center w-full my-6">
                    <span class="w-full p-2 text-center text-white bg-indigo-600 rounded cursor-pointer hover:bg-indigo-500">Post Review</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed, ref, toRef, watch } from 'vue';

const recording = ref(false);
const audioBlob = ref(null);
const audioBlobUrl = ref('');



let mediaRecorder;
let chunks = [];

const props = defineProps(['filledCount', 'summary', 'experience', 'activeDiv','selectedCompany','customCountry','selectedTag','customTag']);
const selectedCompanyValue = ref(props.selectedCompany);

watch(() => props.selectedCompany, (newValue) => {
  selectedCompanyValue.value = newValue;
});

const formattedText = computed(() => {
  return props.experience.replace(/\n/g, '\n'); // Replace with '\n' instead of '<br>' for line breaks
});

const starClass = (index) => {
  if (index < props.filledCount) {
    return 'text-yellow-300';
  } else {
    return 'text-gray-300';
  }
};

function startRecording() {
  navigator.mediaDevices.getUserMedia({ audio: true })
    .then(stream => {
      mediaRecorder = new MediaRecorder(stream);
      mediaRecorder.addEventListener('dataavailable', handleDataAvailable);
      mediaRecorder.start();
      recording.value = true;
    })
    .catch(error => {
      console.error('Failed to access microphone:', error);
    });
}

function stopRecording() {
  mediaRecorder.stop();
  recording.value = false;
}

function handleDataAvailable(event) {
  chunks.push(event.data);
  if (mediaRecorder.state === 'inactive') {
    const blob = new Blob(chunks, { type: 'audio/wav' });
    const blobUrl = URL.createObjectURL(blob);
    audioBlob.value = blob;
    audioBlobUrl.value = blobUrl;
    chunks = [];
  }
}
</script>