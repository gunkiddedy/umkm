<template>
    <transition name="fade">
        <div class="bg-white h-full w-64 rounded-lg mr-6 shadow px-1 py-1">
            <div class="grid grid-cols-1 my-2 px-1">
                <div class="text-gray-500 flex items-center justify-between">
                    <router-link to="/company-list" class="w-full">
                        <button type="button" class="w-full flex items-center leading-tight text-sm py-4 px-4 hover:bg-blue-500 hover:text-gray-300 rounded-lg">
                            <svg class="w-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10.496 2.132a1 1 0 00-.992 0l-7 4A1 1 0 003 8v7a1 1 0 100 2h14a1 1 0 100-2V8a1 1 0 00.496-1.868l-7-4zM6 9a1 1 0 00-1 1v3a1 1 0 102 0v-3a1 1 0 00-1-1zm3 1a1 1 0 012 0v3a1 1 0 11-2 0v-3zm5-1a1 1 0 00-1 1v3a1 1 0 102 0v-3a1 1 0 00-1-1z" clip-rule="evenodd">
                                </path>
                            </svg>
                            <span class="font-semibold">Company List {{ getComp !== 0 ? getComp : '' }} </span>
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
                            <span class="font-semibold">Product List {{ getProd !== 0 ? getProd : '' }}</span>
                        </button>
                    </router-link>
                </div>
                <div class="text-gray-500 flex items-center justify-between">
                    <router-link to="/user-blacklist" class="w-full">
                        <button type="button" class="w-full flex items-center leading-tight text-sm py-4 px-4 hover:bg-blue-500 hover:text-gray-300 rounded-lg">
                            <svg class="w-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M13.477 14.89A6 6 0 015.11 6.524l8.367 8.368zm1.414-1.414L6.524 5.11a6 6 0 018.367 8.367zM18 10a8 8 0 11-16 0 8 8 0 0116 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="font-semibold">Blacklisted User {{ getBlack !== 0 ? getBlack : '' }}</span>
                        </button>
                    </router-link>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
export default {

    mounted() {
        this.$store.dispatch('messageForAdmin/handleCompanyRequest');
        this.$store.dispatch('messageForAdmin/handleProductRequest');
        this.$store.dispatch('messageForAdmin/handleBlacklistRequest');
    },

    computed: {
        getComp: function () {
            return this.$store.getters['messageForAdmin/get_companyRequest'];
        },
        getProd: function () {
            return this.$store.getters['messageForAdmin/get_productRequest'];
        },
        getBlack: function () {
            return this.$store.getters['messageForAdmin/get_blacklistRequest'];
        }
    }
}
</script>

<style scoped>
    .router-link-active,
    .router-link-exact-active {
        background-color: #4299e1;
        color: #e2e8f0;
        cursor: pointer;
        border-radius: 0.5rem;
    }
</style>