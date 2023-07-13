<template>
    <div class="flex flex-col justify-center flex-1 min-h-full px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <!-- <img class="w-auto h-auto mx-auto" src="https://logos.flamingtext.com/Word-Logos/review-design-sketch-name.png" alt="Your Company" /> -->
            <h2 class="mt-10 text-2xl font-bold leading-9 tracking-tight text-center text-gray-900">Register for a New Account</h2>
        </div>
        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <div v-if="success" class="p-2 mb-5 text-center bg-green-500 border rounded">
                    <div class="text-sm font-semibold text-white" >{{ success }}</div>
                </div>
            <div class="space-y-6">
                <div>
                    <label for="firstname" class="block text-sm font-medium leading-6 text-gray-900">Full Name <span class="text-red-600">*</span></label>
                    <div class="mt-2">
                        <input id="firstname" name="firstname" v-model="fullName" type="text" required="" class="block w-full focus:outline-none px-2 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                        <div class="mt-1 text-sm text-red-600" v-if="error.name">{{ error.name }}</div> 
                    </div>
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address <span class="text-red-600">*</span></label>
                    <div class="mt-2">
                        <input id="email" name="email" v-model="email" type="email" autocomplete="email" required="" class="block w-full focus:outline-none px-2 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                        <div class="mt-1 text-sm text-red-600" v-if="error.email">{{ error.email }}</div> 
                    </div>
                </div>
                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password <span class="text-red-600">*</span></label>
                    </div>
                    <div class="mt-2">
                        <input id="password" name="password" v-model="password" type="password" autocomplete="current-password" required="" class="block w-full focus:outline-none px-2 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                        <div class="mt-1 text-sm text-red-600" v-if="error.password">{{ error.password }}</div>                        
                    </div>
                </div>
                <div>
                    <label for="lastname" class="block text-sm font-medium leading-6 text-gray-900">Confirm Password <span class="text-red-600">*</span></label>
                    <div class="mt-2">
                        <input id="lastname" name="lastname" v-model="confirmPassword" type="password" required="" class="block w-full focus:outline-none px-2 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                        <div class="mt-1 text-sm text-red-600" v-if="error.password_confirmation">{{ error.password_confirmation }}</div>
                    </div>
                </div>
                <div>
                    <button type="button" @click="registerUser" class="flex w-full justify-center cursor-pointer rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Register</button>
                </div>
                <div id="recaptchaContainer"></div>
                <div v-if="error.recaptchaError" class="text-sm text-red-600">
                    {{ error.recaptchaError }}
                </div>
            </div>
            <p class="mt-10 text-sm text-center text-gray-500">
                Already have an account?
                {{ ' ' }}
                <RouterLink :to="{name:'Login'}" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">
                    Login
                </RouterLink>
            </p>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, reactive } from 'vue';
import Auth from "@/composables/Auth"
import { useRouter } from 'vue-router';

const { register } = Auth()
const recaptchaResponse = ref('');
const fullName = ref("")
const email = ref("")
const password = ref("")
const confirmPassword = ref("")
const success = ref(false)
const route = useRouter()

const error = reactive({
name: false,
email: false,
password: false,
password_confirmation: false,
recaptchaError :false
})

const registerUser = () => {
    resetErrors()
    if (!recaptchaResponse.value) {
        error.recaptchaError = 'Please complete the reCAPTCHA verification'
        return;
    }
    let data = {
        name: fullName.value,
        email: email.value,
        password: password.value,
        password_confirmation:confirmPassword.value,
    }
    register(data).then((response)=>{
        if(response.status === 201){
            success.value = 'Your account has been created successfully'
            resetForm()
            route.push('/login')
        }else{
            if(response.data.errors){
                for(let key in error){
                    if(key in response.data.errors){
                        error[key] = response.data.errors[key][0]
                    }
                }
            }
        }
    })
};

const resetForm = () => {
    fullName.value = email.value = password.value = confirmPassword.value = ''
}

const resetErrors = () => {

success.value = false
Object.keys(error).forEach(key => error[key] = false)
}

// Recaptcha Verification
const initRecaptcha = () => {
  return new Promise((resolve, reject) => {
    const script = document.createElement('script');
    script.src = 'https://www.google.com/recaptcha/api.js?onload=recaptchaOnLoadCallback&render=explicit';
    script.async = true;
    script.defer = true;
    document.body.appendChild(script);
    window.recaptchaOnLoadCallback = () => {
      grecaptcha.render('recaptchaContainer', {
        sitekey: '6Lf96gEnAAAAABSJvPExr4sc6xZRuoPn5kp6dqPd',
        callback: (response) => {
          recaptchaResponse.value = response;
        },
        'error-callback': () => {
          reject(new Error('Failed to load reCAPTCHA'));
        },
      });
      resolve();
    };
  });
};

onMounted(() => {
  initRecaptcha()
    .then(() => {
    //   console.log('reCAPTCHA loaded successfully');
    })
    .catch((error) => {
      console.error(error);
    });
});
</script>

