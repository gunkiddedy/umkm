<template>
<div>
    <header>
        <div class="px-4 py-4 flex justify-between items-center">

            <router-link to="/">
                <span class="normal-case font-omnia text-gray-600 text-2xl lg:text-2xl tracking-wide font-semibold">
                    UMKM-GUNUNGKIDUL
                </span>
            </router-link>
            
            <!-- SMALL DROPDOWN MENU  -->
            <div class="relative    " v-if="isloggedIn === 'true'">
                <div class="w-full flex justify-between items-center">
                    <!--<div class="border-l h-8 border-gray-600 mr-4"></div>-->
                    <div class="leading-tight text-sm font-semibold text-gray-600 w-32">
                        {{ companyName }}
                    </div>
                    <img @click="toggleDropdownUser" src="/img/avatar2.png" alt="avatar" class="shadow hover:opacity-75 object-cover rounded-full w-8 h-8 mx-auto ml-2 cursor-pointer">
                </div>
                <div v-if="showUserDropdown" class="text-sm font-semibold z-20 shadow user-drop bg-white absolute py-2 px-4 rounded-lg right-0 w-48 flex flex-col">
                    <router-link to="/company-list" v-if="user_role === 'admin'" class="rounded px-2 py-2 hover:bg-gray-100 text-gray-500 hover:text-blue-400 cursor-pointer leading-tight">
                        <span>
                            Dashboard
                        </span>
                    </router-link>
                    <router-link :to="{ name: 'company-page', params: {id: user_id } }" v-else class="rounded px-2 py-2 hover:bg-gray-100 text-gray-500 hover:text-blue-400 cursor-pointer leading-tight">
                        <span>
                            My Products
                        </span>
                    </router-link>
                    <span class="rounded px-2 py-2 hover:bg-gray-100 text-gray-500 hover:text-blue-400 cursor-pointer leading-tight" @click="logoutUser">
                        Logout
                    </span>
                </div>
            </div>

            <!-- login register button-->
            <div v-else class="w-64 flex justify-between items-center">
                <router-link to="/login">
                    <button class="bg-orange-custom px-4 py-2 rounded-lg w-48 hover:bg-orange-400" type="button">
                        <span class="leading-tight text-white font-semibold">Login / Register</span>
                    </button>
                </router-link>
            </div>
        </div>
    </header>
    <div class="-ml-16 -mr-16 border-t border-gray-300"></div>
</div>
</template>

<script>
export default {
    data() {
        return {
            isloggedIn: 'false',
            showUserDropdown: false,
            desa_id: '',
        }
    },

    mounted() {
        this.isloggedIn = localStorage.getItem('isloggedIn');
        this.companyName = localStorage.getItem('username');
        this.desa_id = localStorage.getItem('desa_id');
        this.user_role = localStorage.getItem('user_role');
    },

    methods: {
        toggleDropdownUser() {
            this.showUserDropdown = !this.showUserDropdown;
        },

        logoutUser() {
            axios.get('/sanctum/csrf-cookie')
                .then(response => {
                    axios.post('/api/logout')
                        .then(res => {
                            this.$router.push({
                                name: "login"
                            });
                            localStorage.setItem('isloggedIn', 'false');
                            localStorage.removeItem('username');
                            localStorage.removeItem('desa_id');
                            localStorage.removeItem('user_role');
                            this.isloggedIn = 'false';
                        }).catch(err => {
                            console.log(err);
                        });
                }).catch(error => {
                    console.log(error);
                });
        }
    },

}
</script>
