<template>
<div>
    <div class="flex" v-if="!isloading">
        <transition name="fade">
            <div class="image-login w-3/5 h-screen">
                <img src="/img/login-img.png" alt="" class="w-full h-full">
            </div>
        </transition>

        <transition name="fade">
            <div class="login-form bg-gray-300 w-2/5 h-screen px-24 py-6">

                <div class="w-full bg-gray-300 h-full ">

                    <div class="flex items-center justify-end">
                        <router-link to="/">
                            <button class="bg-white relative w-8 h-8 hover:shadow-outline rounded-full p-1 text-gray-800 focus:outline-none">
                                <svg class=" w-4 mx-auto" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </router-link>
                    </div>

                    <div class="mt-16 w-1/2 flex flex-wrap">
                        <span class="text-blue-600 font-bold leading-tight">
                            Please sign in
                            <span class="text-blue-400 font-semibold leading-tight">
                                to experience the most of our service!
                            </span>
                        </span>
                    </div>

                    <div class="border-t border-gray-400 w-full my-6"></div>

                    <div v-if="errors.message" class="flex items-center relative">
                        <span class="text-red-400 font-semibold text-sm mb-2">{{ errors.message }}</span>
                    </div>

                    <form @submit.prevent="handleLogin">
                        <div class="mb-4 flex items-center relative">
                            <input id="email" type="email" name="email" v-model="user.email" placeholder="Email (example@gmail.com)" class="rounded-lg py-3 px-4 text-gray-700 border border-gray-300 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 w-full" required autocomplete="email">
                            <svg class="w-4 absolute right-0 mr-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                            </svg>
                        </div>

                        <div class="mb-4 flex items-center relative">
                            <input id="password" type="password" name="password" v-model="user.password" placeholder="Password" class="rounded-lg py-3 px-4 text-gray-700 border border-gray-300 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 w-full">
                            <svg class="w-4 absolute right-0 mr-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                            </svg>
                        </div>

                        <div class="stay flex items-center justify-between mb-8">
                            <div class="flex items-center">
                                <div class="bg-white border-2 rounded border-gray-400 w-6 h-6 flex flex-shrink-0 justify-center items-center mr-2 focus-within:border-blue-500">
                                    <input name="remember" id="remember" type="checkbox" true-value="1" false-value="0" class="opacity-0 absolute">
                                    <svg class="fill-current hidden w-4 h-4 text-green-500 pointer-events-none" viewBox="0 0 20 20">
                                        <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                    </svg>
                                </div>
                                <label for="remember" class="text-gray-500 font-semibold">
                                    Stay signed in
                                </label>
                            </div>
                            <div>
                                <a href="/password/reset">
                                    <span class="text-blue-700 font-bold hover:text-blue-400">Forgot Password?</span>
                                </a>
                            </div>
                        </div>

                        <div class="relative">
                            <button @click="handleLogin" type="button" class="px-6 py-2 w-full rounded-lg hover:bg-orange-400 bg-orange-custom text-white font-semibold leading-tight">
                                <svg v-if="isLoging" class="absolute animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                {{ isLoging ? "Processing..." : "Sign in" }}
                            </button>
                        </div>
                    </form>

                    <div class="border-t border-gray-400 w-full my-8"></div>

                    <div class="flex">
                        <div class="mr-6"><span class="text-gray-500 font-semibold">Don't have an account?</span></div>
                        <div>
                            <router-link to="/register">
                                <span class="text-blue-600 font-bold hover:text-blue-400">Sign Up</span>
                            </router-link>
                        </div>
                    </div>

                </div>
            </div>
        </transition>

    </div>

    <!-- loader spin-->
    <div v-if="isloading" class="mx-auto flex h-screen">
        <div class="flex justify-center items-center w-full">
            <svg class="w-12" viewBox="0 0 120 30" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                <circle cx="15" cy="15" r="15">
                    <animate attributeName="r" from="15" to="15" begin="0s" dur="0.8s" values="15;9;15" calcMode="linear" repeatCount="indefinite" />
                    <animate attributeName="fill-opacity" from="1" to="1" begin="0s" dur="0.8s" values="1;.5;1" calcMode="linear" repeatCount="indefinite" />
                </circle>
                <circle cx="60" cy="15" r="9" fill-opacity="0.3">
                    <animate attributeName="r" from="9" to="9" begin="0s" dur="0.8s" values="9;15;9" calcMode="linear" repeatCount="indefinite" />
                    <animate attributeName="fill-opacity" from="0.5" to="0.5" begin="0s" dur="0.8s" values=".5;1;.5" calcMode="linear" repeatCount="indefinite" />
                </circle>
                <circle cx="105" cy="15" r="15">
                    <animate attributeName="r" from="15" to="15" begin="0s" dur="0.8s" values="15;9;15" calcMode="linear" repeatCount="indefinite" />
                    <animate attributeName="fill-opacity" from="1" to="1" begin="0s" dur="0.8s" values="1;.5;1" calcMode="linear" repeatCount="indefinite" />
                </circle>
            </svg>
        </div>
    </div>

</div>
</template>

<script>
import {
    mapGetters
} from 'vuex'
export default {

    data() {
        return {
            user: {
                email: '',
                password: ''
            },
            errors: {},
            isLoging: false,
            isloading: true,
        }
    },

    mounted() {
        setTimeout(() => {
            this.isloading = false;
        }, 700)
    },

    methods: {
        handleLogin() {
            this.isLoging = true;
            axios.get('/sanctum/csrf-cookie')
                .then((response) => {
                    axios.post('/api/login', this.user)
                        .then((response) => {
                            if (response.data.user.role === 'member') {
                                this.$router.push({
                                    name: "desa-page",
                                    params: {
                                        id: response.data.user.dfdesa_id
                                    }
                                });
                            } else if (response.data.user.role === 'admin') {
                                this.$router.push({
                                    name: "company-list"
                                });
                            }
                            this.isLoging = false;
                            localStorage.setItem('isloggedIn', 'true');
                            localStorage.setItem('username', response.data.user.username);
                            localStorage.setItem('desa_id', response.data.user.dfdesa_id);
                            localStorage.setItem('user_role', response.data.user.role);
                        })
                        .catch((error) => {
                            this.errors = error;
                            this.isLoging = false;
                            console.log(this.errors)
                        });
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                });
        },

    }
}
</script>

<style>
.fade-enter-active,
.fade-leave-active {
    transition: opacity .5s;
}

/* .fade-leave-active below version 2.1.8 */
.fade-enter,
.fade-leave-to {
    opacity: 0;
}
</style>
