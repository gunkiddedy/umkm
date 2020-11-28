<template>
<div>
    <div class="px-16 bg-gray-100">
        <header-component></header-component>
        <div class="flex px-4 py-4 mt-4">
            <!-- SIDEBAR MENU-->
            <!--<transition name="fade">
                <div class="bg-white h-full w-64 rounded-lg mr-6 shadow px-1 py-1">
                    <div class="grid grid-cols-1 my-2 px-1">
                        <div class="text-gray-500 flex items-center justify-between">
                            <router-link to="/company-list" class="w-full">
                                <button type="button" class="w-full flex items-center leading-tight text-sm py-4 px-4 hover:bg-blue-500 hover:text-gray-300 rounded-lg text-gray-300">
                                    <svg class="w-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M10.496 2.132a1 1 0 00-.992 0l-7 4A1 1 0 003 8v7a1 1 0 100 2h14a1 1 0 100-2V8a1 1 0 00.496-1.868l-7-4zM6 9a1 1 0 00-1 1v3a1 1 0 102 0v-3a1 1 0 00-1-1zm3 1a1 1 0 012 0v3a1 1 0 11-2 0v-3zm5-1a1 1 0 00-1 1v3a1 1 0 102 0v-3a1 1 0 00-1-1z" clip-rule="evenodd">
                                        </path>
                                    </svg>
                                    <span class="font-semibold">Company List</span>
                                </button>
                            </router-link>
                        </div>
                        <div class="text-gray-500 flex items-center justify-between">
                            <router-link to="/product-list" class="w-full">
                                <button type="button" class="w-full flex items-center leading-tight text-sm py-4 px-4 hover:bg-blue-500 hover:text-gray-300 rounded-lg">
                                    <svg class="w-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M5 5a3 3 0 015-2.236A3 3 0 0114.83 6H16a2 2 0 110 4h-5V9a1 1 0 10-2 0v1H4a2 2 0 110-4h1.17C5.06 5.687 5 5.35 5 5zm4 1V5a1 1 0 10-1 1h1zm3 0a1 1 0 10-1-1v1h1z" clip-rule="evenodd"></path>
                                        <path d="M9 11H3v5a2 2 0 002 2h4v-7zM11 18h4a2 2 0 002-2v-5h-6v7z"></path>
                                    </svg>
                                    <span class="font-semibold">Product List</span>
                                </button>
                            </router-link>
                        </div>
                        <div class="text-gray-500 flex items-center justify-between">
                            <router-link to="/user-blacklist" class="w-full">
                                <button type="button" class="w-full flex items-center leading-tight text-sm py-4 px-4 hover:bg-blue-500 hover:text-gray-300 rounded-lg">
                                    <svg class="w-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M13.477 14.89A6 6 0 015.11 6.524l8.367 8.368zm1.414-1.414L6.524 5.11a6 6 0 018.367 8.367zM18 10a8 8 0 11-16 0 8 8 0 0116 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="font-semibold">Blacklisted User</span>
                                </button>
                            </router-link>
                        </div>
                    </div>
                </div>
            </transition>-->
            <admin-sidebar></admin-sidebar>
            <transition name="fade">
                <div class="w-full">
                    <!-- COMPANY SEARCH-->
                    <div class="relative">
                        <form @submit.prevent="searchCompanies">
                            <button type="submit" class="absolute right-0 mt-2 mr-2 text-gray-500">
                                <svg class="w-4" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </button>
                            <input v-model="keyword" class="shadow appearance-none rounded-full w-full py-1 px-3 text-gray-700 leading-tight  focus:outline-none focus:shadow-inner" id="search" type="search" placeholder="Search company">
                        </form>
                    </div>
                    <div v-if="product_not_found !== ''" class="my-4 flex justify-center text-gray-500">
                        {{ product_not_found }}
                    </div>
                    <!-- loader spin-->
                    <div v-if="loading" class="z-30 flex justify-around relative opacity-25 bg-black inset-0 mt-4">
                        <svg class="w-12 absolute" viewBox="0 0 120 30" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
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
                    <div class="mt-10 mb-12 w-full h-full">
                        <div class="grid grid-cols-4 gap-4">
                            <!-- company list with their products-->
                            <div class="bg-white rounded-lg flex flex-col px-0 py-0 shadow" v-for="(company, index) in companies" :key="index">
                                <!-- USER ACTIVE STATUS-->
                                <div class="flex justify-end mb-1">
                                    <span v-if="company.is_active === 1 && company.is_blacklist ===0" class="px-2 bg-gray-100 rounded-tr-md rounded-bl-md text-blue-500 shadow-sm text-sm font-semibold">Active</span>
                                    <span v-else class="px-2 bg-gray-100 rounded-tr-md rounded-bl-md text-red-600 shadow-sm text-xs font-semibold">Inactive User</span>
                                </div>
                                <!--<div class="flex items-center justify-between">-->
                                <!-- BLUE CIRCLE-->
                                <div class="flex flex-col items-center px-2 py-2">
                                    <!--<div class="bg-blue-500 rounded-full w-16 h-16 mr-6"></div>-->
                                    <router-link :to="{ name: 'company-page', params: {id: company.id } }">
                                        <img src="/img/avatar2.png" alt="avatar" class="shadow hover:opacity-75 object-cover rounded-full w-16 h-16 mb-2">
                                    </router-link>
                                    <!-- COMPANY NAME-->
                                    <div>
                                        <router-link :to="{ name: 'company-page', params: {id: company.id } }">
                                            <p class="uppercase font-semibold text-sm text-gray-500 hover:text-blue-500">
                                                {{ company.name }}
                                            </p>
                                        </router-link>
                                    </div>
                                    <div>
                                        <span class="text-sm text-blue-500 font-semibold hover:text-blue-700">
                                            <a :href="'mailto:'+company.email">{{ company.email }}</a>
                                        </span>
                                    </div>
                                    <div class="w-3/4 px-1">
                                        <span class="text-xs text-gray-500 hover:text-blue-500">{{company.address}}</span>
                                        <span class="text-xs text-gray-500 hover:text-blue-500" v-if="company.address === null">Bekasi, Jawa Barat, Indonesia</span>
                                    </div>
                                    <!-- BUTTON BLACKLIST USER-->
                                    <div class="my-3">
                                        <button v-if="company.is_active === 1 && company.is_blacklist === 0" @click="setUserInActive(company.id)" class="bg-gray-500 rounded-full px-3 py-1 hover:bg-red-600 text-white hover:text-gray-100 font-semibold text-xs">
                                            {{ approvinguser && approvingUserId === company.id ? 'Processing...': 'Blacklist'}}
                                        </button>
                                        <button v-if="company.is_active === 0 && company.is_blacklist === 0" @click="setUserActive(company.id)" class="bg-blue-500 rounded-full px-3 py-1 hover:bg-blue-600 text-white hover:text-gray-100 font-semibold text-xs">
                                            {{ approvinguser && approvingUserId === company.id ? 'Processing...': 'Set Active'}}
                                        </button>
                                    </div>
                                    <!--</div>-->
                                </div>
                            </div>
                        </div>
                        <!-- PAGINATION -->
                        <div class="flex justify-around items-center mt-16">
                            <pagination :pagination="pagination" @paginate="loadMembers" />
                        </div>
                    </div>
                </div>
            </transition>
        </div>
    </div>
    <footer-component></footer-component>
</div>
</template>

<script>
export default {
    data() {
        return {
            companies: [],
            loading: true,
            approvinguser: false,
            approvingUserId: null,
            product_not_found: '',
            pagination: {},
            keyword: '',
            selected: {
                keyword: ''
            }
        }
    },

    mounted() {
        this.loadMembers();

        if(localStorage.getItem('isloggedIn')== 'false'){
            this.$router.push('/login');
        }

        if(localStorage.getItem('user_role')== 'member' || localStorage.getItem('user_id') !== '1' ){
            this.$router.push({
                name: "company-page",
                params: {
                    id: localStorage.getItem('user_id')
                }
            });
        }
    },

    watch: {
        selected: {
            handler: function () {
                this.loadMembers();
            },
            deep: true
        }
    },

    methods: {
        setUserActive(user_id){
            this.approvinguser = true;
            this.approvingUserId = user_id;
            axios.get('/sanctum/csrf-cookie')
            .then((response) => {
                axios.post('/api/set-user-active/' + user_id)
                .then((response) => {
                    setTimeout(()=>{
                        this.approvinguser = false;
                    },1000);
                    this.$store.dispatch('messageForAdmin/handleCompanyRequest');
                    this.loadMembers();
                    // console.log(response);
                })
                .catch(error => {
                    console.log(error);
                });
            }).catch(error => {
                console.log(error);
            })
        },
        
        // blacklist
        setUserInActive(user_id){
            this.approvinguser = true;
            this.approvingUserId = user_id;
            axios.get('/sanctum/csrf-cookie')
            .then((response) => {
                axios.post('/api/set-user-inactive/' + user_id)
                .then((response) => {
                    setTimeout(()=>{
                        this.approvinguser = false;
                    },1000);
                    this.$store.dispatch('messageForAdmin/handleBlacklistRequest');
                    this.loadMembers();
                    // console.log(response);
                })
                .catch(error => {
                    console.log(error);
                });
            }).catch(error => {
                console.log(error);
            })
        },

        searchCompanies(){
            axios.get('/sanctum/csrf-cookie')
            .then(res => {
                this.selected.keyword = this.keyword;
            })
            .catch(err => {
                console.log(err);
            })
        },

        loadMembers() {
            let current_page  = this.pagination.current_page;
            let pageNum = current_page ? current_page : 1;
            axios.get('/sanctum/csrf-cookie')
            .then((response) => {
                axios.get('/api/company-list?page='+pageNum, {
                    params: this.selected
                })
                .then((response) => {
                    this.loading = false;
                    this.pagination = response.data;
                    this.companies = response.data.data;
                    if(response.data.length == 0){
                        this.product_not_found = 'company not found';
                    }
                    console.log(response.data);
                })
                .catch(error => {
                    console.log(error);
                });
            }).catch(error => {
                console.log(error);
            })
        },

    },
}
</script>

<style scoped>
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
