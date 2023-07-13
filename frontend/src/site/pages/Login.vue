<template>
    <div class="flex flex-col justify-center flex-1 min-h-full px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <!-- <img class="w-auto h-auto mx-auto" src="https://logos.flamingtext.com/Word-Logos/review-design-sketch-name.png" alt="Your Company" /> -->
            <h2 class="mt-10 text-2xl font-bold leading-9 tracking-tight text-center text-gray-900">Log in to your account</h2>
        </div>
        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <div class="space-y-6">
                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address <span class="text-red-600">*</span></label>
                    <div class="mt-2">
                        <input id="email" name="email" type="email" v-model="email" autocomplete="email" required="" class="block w-full focus:outline-none px-2 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                    </div>
                    <div  v-for="message in emailError" :key="message" class="mt-2 text-sm font-medium text-red-600">
                        {{ message }}
                    </div>
                </div>
                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password <span class="text-red-600">*</span></label>
                    </div>
                    <div class="mt-2">
                        <input id="password" name="password" type="password" v-model="password" autocomplete="current-password" required="" class="block w-full focus:outline-none px-2 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                    </div>
                    <div  v-if="passwordError == 'email or password wrong'" class="mt-2 text-sm font-medium text-red-600">
                        {{ passwordError }}
                    </div>
                    <div v-if="error" class="mt-2 text-sm font-medium text-red-600">
                        {{ error }}
                    </div>
                </div>
                <div>
                    <button type="button" @click="proceedLogin" class="flex w-full justify-center cursor-pointer rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Log in</button >
                </div>
            </div>
            <p class="mt-10 text-sm text-center text-gray-500">
                Don't have an account?
                {{ ' ' }}
                <RouterLink :to="{name:'Register'}" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">
                    Register
                </RouterLink>
            </p>
        </div>
    </div>
</template>

<script setup>
import Auth from "@/composables/Auth"
import { useRouter } from 'vue-router';
import { ref } from 'vue';

const {login} = Auth()
const email = ref("")
const password = ref("")
const passwordError = ref(false)
const emailError = ref(false)
const error = ref(false)
const route = useRouter()

const proceedLogin = () => {
    passwordError.value = false
    emailError.value = false
    error.value = false
    if (email.value !== '' && password.value !== ''){
        login(email.value, password.value).then((response)=>{
            if(response.status == 200){
                resetForm()
                if(response.data.token){
                    localStorage.setItem("reviewAccessToken", response.data.token)
                    // emit('response')
                    route.push('/')
                    //Here we can push the user route where we want to change the route of the user after successfully login
                }
            }else{
                passwordError.value = response.response.data.message
                emailError.value = response.response.data.message.email
            }
        })
    }else{
        error.value = 'Email and password required'
    }
}

const resetForm = () => {
    email.value = password.value = ''
}

</script>

