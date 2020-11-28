<template>
<div>
    <div class="px-16 bg-gray-100">
        <header-component></header-component>
        <div class="flex px-4 py-4 mt-4">

            <!-- SIDEBAR (be a modal when clicked on one of the button) -->
            <div class="bg-white h-full w-64 rounded-lg mr-6 shadow" :class="{'relative': showModalSidebar, 'inset-0':showModalSidebar, 'z-50': showModalSidebar}">

                <div class="bg-blue-500 rounded-t-lg h-12">
                    <p class="px-8 py-3 text-gray-100 font-semibold">
                        Filter
                    </p>
                </div>

                <div class="px-6 mb-3 mt-3">
                    <p class="py-2 text-gray-800 font-semibold leading-tight">Provinsi</p>
                    <button @click="provinsiModal()" type="button" id="btn-prop" class="w-full flex justify-between leading-tight py-2 px-4 border rounded shadow-xs border-gray-400 text-left">
                        <P class="text-sm text-gray-700">Show All</P>
                        <svg class="w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>

                <div class="px-6 mb-3 mt-3">
                    <p class="py-2 text-gray-800 font-semibold leading-tight">Kabupaten</p>
                    <button @click="kabupatenModal()" type="button" class="w-full flex justify-between leading-tight py-2 px-4 border rounded shadow-xs border-gray-400 text-left">
                        <P class="text-sm text-gray-700">Show All</P>
                        <svg class="w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>

                <div class="px-6 mb-3 mt-3">
                    <p class="py-2 text-gray-800 font-semibold leading-tight">Category</p>
                    <button @click="categoryModal()" type="button" class="w-full flex justify-between leading-tight py-2 px-4 border rounded shadow-xs border-gray-400 text-left">
                        <P class="text-sm text-gray-700">Show All</P>
                        <svg class="w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>

                <div class="px-6 mb-8 mt-3">
                    <p class="py-2 text-gray-800 font-semibold leading-tight">Sub Category</p>
                    <button @click="subcategoryModal()" type="button" class="w-full flex justify-between leading-tight py-2 px-4 border rounded shadow-xs border-gray-400 text-left">
                        <P class="text-sm text-gray-700">Show All</P>
                        <svg class="w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>

            </div>

            <!-- PROVINSI MODAL-->
            <div v-if="showModalProv" class="h-full w-full" :class="{'relative': showModalProv, 'inset-0':showModalProv, 'z-50': showModalProv}">
                <div class="bg-white border-0 rounded-lg shadow-lg px-6 py-4">
                    <div class="grid grid-cols-5 gap-4">
                        <div>
                            <p class="font-semibold text-sm uppercase text-gray-600">{{ islands[0].name }}</p>
                            <ul class="mt-2">
                                <li  v-for="(prov, i) in islands[0].provinsis" :key="i" class="text-xs text-gray-500 hover:text-gray-600 hover:bg-gray-100 font-semibold cursor-pointer mt-1" @click="handleSelectingProvinsi(prov.id, prov.name)">
                                    <span class="text-pink-400" v-if="isSelectingProvId === prov.id">
                                        {{ prov.name }}
                                    </span>
                                    <span v-else>
                                        {{ prov.name }}
                                    </span>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <p class="font-semibold text-sm uppercase text-gray-600">{{ islands[1].name }}</p>
                            <ul class="mt-2">
                                <li  v-for="(prov, i) in islands[1].provinsis" :key="i" class="text-xs text-gray-500 hover:text-gray-600 font-semibold  hover:bg-gray-100 cursor-pointer mt-1" @click="handleSelectingProvinsi(prov.id, prov.name)">
                                    <span class="text-pink-400" v-if="isSelectingProvId === prov.id">
                                        {{ prov.name }}
                                    </span>
                                    <span v-else>
                                        {{ prov.name }}
                                    </span>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <p class="font-semibold text-sm uppercase text-gray-600">{{ islands[2].name }}</p>
                            <ul class="mt-2">
                                <li  v-for="(prov, i) in islands[2].provinsis" :key="i" class="text-xs text-gray-500 hover:text-gray-600 font-semibold  hover:bg-gray-100 cursor-pointer mt-1" @click="handleSelectingProvinsi(prov.id, prov.name)">
                                    <span class="text-pink-400" v-if="isSelectingProvId === prov.id">
                                        {{ prov.name }}
                                    </span>
                                    <span v-else>
                                        {{ prov.name }}
                                    </span>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <p class="font-semibold text-sm uppercase text-gray-600">{{ islands[3].name }}</p>
                            <ul class="mt-2">
                                <li  v-for="(prov, i) in islands[3].provinsis" :key="i" class="text-xs text-gray-500 hover:text-gray-600 font-semibold  hover:bg-gray-100 cursor-pointer mt-1" @click="handleSelectingProvinsi(prov.id, prov.name)">
                                    <span class="text-pink-400" v-if="isSelectingProvId === prov.id">
                                        {{ prov.name }}
                                    </span>
                                    <span v-else>
                                        {{ prov.name }}
                                    </span>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <p class="font-semibold text-sm uppercase text-gray-600">{{ islands[4].name }}</p>
                            <ul class="mt-2">
                                <li  v-for="(prov, i) in islands[4].provinsis" :key="i" class="text-xs text-gray-500 hover:text-gray-600 font-semibold  hover:bg-gray-100 cursor-pointer mt-1" @click="handleSelectingProvinsi(prov.id, prov.name)">
                                    <span class="text-pink-400" v-if="isSelectingProvId === prov.id">
                                        {{ prov.name }}
                                    </span>
                                    <span v-else>
                                        {{ prov.name }}
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="w-full border-t border-gray-400 my-4"></div>

                    <div class="grid grid-cols-5 gap-4">
                        <div>
                            <p class="font-semibold text-sm uppercase text-gray-600">{{ islands[5].name }}</p>
                            <ul class="mt-2">
                                <li  v-for="(prov, i) in islands[5].provinsis" :key="i" class="text-xs text-gray-500 hover:text-gray-600 font-semibold  hover:bg-gray-100 cursor-pointer mt-1" @click="handleSelectingProvinsi(prov.id, prov.name)">
                                    <span class="text-pink-400" v-if="isSelectingProvId === prov.id">
                                        {{ prov.name }}
                                    </span>
                                    <span v-else>
                                        {{ prov.name }}
                                    </span>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <p class="font-semibold text-sm uppercase text-gray-600">{{ islands[6].name }}</p>
                            <ul class="mt-2">
                                <li  v-for="(prov, i) in islands[6].provinsis" :key="i" class="text-xs text-gray-500 hover:text-gray-600 font-semibold  hover:bg-gray-100 cursor-pointer mt-1" @click="handleSelectingProvinsi(prov.id, prov.name)">
                                    <span class="text-pink-400" v-if="isSelectingProvId === prov.id">
                                        {{ prov.name }}
                                    </span>
                                    <span v-else>
                                        {{ prov.name }}
                                    </span>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <p class="font-semibold text-sm uppercase text-gray-600">{{ islands[7].name }}</p>
                            <ul class="mt-2">
                                <li  v-for="(prov, i) in islands[7].provinsis" :key="i" class="text-xs text-gray-500 hover:text-gray-600 font-semibold  hover:bg-gray-100 cursor-pointer mt-1" @click="handleSelectingProvinsi(prov.id, prov.name)">
                                    <span class="text-pink-400" v-if="isSelectingProvId === prov.id">
                                        {{ prov.name }}
                                    </span>
                                    <span v-else>
                                        {{ prov.name }}
                                    </span>
                                </li>
                            </ul>
                        </div>
                        <!--<span>{{ selectingProvinsi }}</span>-->
                        <div class="col-span-2">
                            <div class="flex justify-end items-center">
                                <button @click="applyFilterProvinsi" class="hover:bg-blue-600 flex items-center text-white border border-blue-500 bg-blue-500 hover:text-gray-100 font-bold text-sm px-6 py-1 rounded focus:outline-none" type="button" >
                                    <svg v-if="isFilteringProvinsi" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    {{ isFilteringProvinsi ? 'Filtering...': 'Apply filter' }}
                                </button>
                                <button @click="resetFilterProvinsi" class="ml-4 flex items-center text-white border border-gray-500 bg-gray-500 hover:bg-gray-600 hover:text-gray-100 font-bold text-sm px-6 py-1 rounded focus:outline-none" type="button" >
                                    <svg v-if="isResetingProvinsi" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    {{ isResetingProvinsi ? 'Reseting...': 'Reset filter' }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- KABUPATEN MODAL-->
            <div v-if="showModalKab" class="w-2/7 overflow-y-auto" :class="{'relative': showModalKab, 'inset-0':showModalKab, 'z-50': showModalKab, 'h-full':!isSelectingProvId,'h-82':isSelectingProvId}">
                <div class="bg-white border-0 rounded-lg shadow-lg px-6 py-4">
                    <div class="grid grid-cols-1">
                        <div class="text-left">
                            <p class="font-semibold text-lg">{{ provinsiTerpilih }}</p>
                            <p class="font-semibold text-lg" v-if="provinsiTerpilih ===''">
                                Provinsi belum dipilih!
                            </p>

                            <div class="flex flex-col text-sm text-gray-500 hover:text-gray-600 mt-2 font-semibold">
                                <ul class="mt-2">
                                    <li  v-for="(kab, i) in kabupatens" :key="i" class="text-xs text-gray-500 hover:text-gray-600 font-semibold  hover:bg-gray-100 cursor-pointer mt-1" @click="handleSelectingKabupaten(kab.id)">
                                        <span class="text-pink-400" v-if="isSelectingKabId === kab.id">
                                            {{ kab.name }}
                                        </span>
                                        <span v-else>
                                            {{ kab.name }}
                                        </span>
                                    </li>
                                </ul>
                            </div>

                            <div class="flex content-end my-4">
                                <button @click="applyFilterKabupaten" class="hover:bg-blue-600 flex items-center text-white border border-blue-500 bg-blue-500 hover:text-gray-100 font-bold text-sm px-6 py-1 rounded focus:outline-none" type="button" >
                                    <svg v-if="isFilteringKabupaten" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    {{ isFilteringKabupaten ? 'Filtering...': 'Apply' }}
                                </button>
                                <button @click="resetFilterKabupaten" class="ml-2 flex items-center text-white border border-gray-500 bg-gray-500 hover:bg-gray-600 hover:text-gray-100 font-bold text-sm px-6 py-1 rounded focus:outline-none" type="button" >
                                    <svg v-if="isResetingKabupaten" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    {{ isResetingKabupaten ? 'Reseting...': 'Reset' }}
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- CATEGORY MODAL-->
            <div v-if="showModalCat" class="h-full w-auto" :class="{'relative': showModalCat, 'inset-0':showModalCat, 'z-50': showModalCat}">
                <div class="bg-white border-0 rounded-lg shadow-lg px-6 py-4">
                    <div class="grid grid-cols-1">
                        <div class="text-left">
                            <p class="font-semibold text-lg">Categories</p>

                            <div class="flex flex-col text-sm text-gray-500 hover:text-gray-600 mt-2 font-semibold">
                                <ul class="mt-2">
                                    <li  v-for="(cat, i) in categories" :key="i" class="text-xs text-gray-500 hover:text-gray-600 font-semibold  hover:bg-gray-100 cursor-pointer mt-1" @click="handleSelectingCategory(cat.id, cat.name)">
                                        <span class="text-pink-400" v-if="isSelectingCatId === cat.id">
                                            {{ cat.name }}
                                        </span>
                                        <span v-else>
                                            {{ cat.name }}
                                        </span>
                                    </li>
                                </ul>
                            </div>

                            <div class="flex content-end my-4">
                                <button @click="applyFilterCategory" class="hover:bg-blue-600 flex items-center text-white border border-blue-500 bg-blue-500 hover:text-gray-100 font-bold text-sm px-6 py-1 rounded focus:outline-none" type="button" >
                                    <svg v-if="isFilteringCategory" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    {{ isFilteringCategory ? 'Filtering...': 'Apply' }}
                                </button>
                                <button @click="resetFilterCategory" class="ml-2 flex items-center text-white border border-gray-500 bg-gray-500 hover:bg-gray-600 hover:text-gray-100 font-bold text-sm px-6 py-1 rounded focus:outline-none" type="button" >
                                    <svg v-if="isResetingCategory" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    {{ isResetingCategory ? 'Reseting...': 'Reset' }}
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- SUB CATEGORY MODAL-->
            <div v-if="showModalSubCat" class="h-full w-auto" :class="{'relative': showModalSubCat, 'inset-0':showModalSubCat, 'z-50': showModalSubCat}">
                <div class="bg-white border-0 rounded-lg shadow-lg px-6 py-4">
                    <div class="grid grid-cols-1">
                        <div class="text-left">
                            <p class="font-semibold text-lg">{{ categoryTerpilih }}</p>
                            <p class="font-semibold text-lg" v-if="categoryTerpilih ===''">
                                Category belum dipilih!
                            </p>

                            <div class="flex flex-col text-sm text-gray-500 hover:text-gray-600 mt-2 font-semibold">
                                <ul class="mt-2">
                                    <li  v-for="(subcat, i) in subcategories" :key="i" class="text-xs text-gray-500 hover:text-gray-600 font-semibold  hover:bg-gray-100 cursor-pointer mt-1" @click="handleSelectingSubCategory(subcat.id)">
                                        <span class="text-pink-400" v-if="isSelectingSubCatId === subcat.id">
                                            {{ subcat.name }}
                                        </span>
                                        <span v-else>
                                            {{ subcat.name }}
                                        </span>
                                    </li>
                                </ul>
                            </div>

                            <div class="flex content-end my-4">
                                <button @click="applyFilterSubCategory" class="hover:bg-blue-600 flex items-center text-white border border-blue-500 bg-blue-500 hover:text-gray-100 font-bold text-sm px-6 py-1 rounded focus:outline-none" type="button" >
                                    <svg v-if="isFilteringSubCategory" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    {{ isFilteringSubCategory ? 'Filtering...': 'Apply' }}
                                </button>
                                <button @click="resetFilterSubCategory" class="ml-2 flex items-center text-white border border-gray-500 bg-gray-500 hover:bg-gray-600 hover:text-gray-100 font-bold text-sm px-6 py-1 rounded focus:outline-none" type="button" >
                                    <svg v-if="isResetingSubCategory" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    {{ isResetingSubCategory ? 'Reseting...': 'Reset' }}
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- PRODUCT SHOW WHEN MODAL IS FALSE-->
            <div class="w-full" v-if="containerProduct">

                <!-- PRODUCT PAGE DESCRIPTIONS -->
                <div class="flex justify-between items-center">
                    <p class="leading-tight text-sm">
                        Menampilkan {{ currentProducts }} produk dari {{ '+'+totalProducts }} produk yang ada di <span class="font-bold">Katalogi</span>
                    </p>
                    <div class="flex justify-between items-center">
                        <p class="mr-2 text-sm">Urutkan :</p>
                        <button type="button" class="bg-white w-48 flex justify-between leading-tight text-sm py-2 px-4 border rounded border-gray-400 text-left">
                            <p>Paling sesuai</p>
                            <svg class="w-4" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>

                    </div>
                </div>

                

                <!-- PRODUCTS  -->
                <div class="mt-8 grid grid-cols-5 gap-4">

                    <div class="text-gray-700 rounded-lg bg-white shadow-md h-72 relative" v-for="product in products.data" :key="product.id">
                        <div>
                            <img :src="'/storage/'+product.image_path" alt="" class="hover:opacity-75 rounded-t-lg object-cover w-full h-41">
                        </div>
                        <div class="absolute px-4 py-4 bg-white rounded-md leading-tight hover:transition duration-300 ease-in-out h-30 -mt-2 overflow-y-hidden hover:h-72 hover:-mt-41">
                            <p class="normal-case mb-6 font-bold text-sm leading-tight h-2.25rem">
                                {{ product.name }}
                            </p>
                            <p class="uppercase text-gray-500 font-semibold leading-tight text-xs h-2.25rem hover:text-blue-400">
                                <router-link :to="{ name: 'company-page', params: {id: product.user_id } }">
                                    {{ product.company_name }}
                                </router-link>
                            </p>
                            <div>
                                <p class="mt-2 mb-2 text-xs text-gray-500">
                                    Jakarta Barat
                                </p>

                                <div class="flex items-center justify-start mb-2">
                                    <div class="rounded-full w-6 h-6 bg-gray-500 flex justify-around items-center px-2 py-2 mr-2">
                                        <p class="text-gray-200 text-xs">SNI</p>
                                    </div>
                                    <span v-if="product.sni" class="text-white bg-green-400 rounded px-1 py-1 text-xs leading-none tracking-normal">
                                        trusted suplier</span>
                                    <span v-else class="text-white bg-red-400 rounded px-1 py-1 text-xs leading-none tracking-normal">
                                        not trusted suplier
                                    </span>
                                </div>

                                <p class="font-bold mb-2">
                                    <span class="text-red-500 font-bold">Rp{{ product.price }}</span>
                                    <span class="text-sm">/pc</span>
                                </p>
                                <p class="text-xs mb-4 text-gray-500">
                                    Visit in order to contact the seller
                                </p>
                                <router-link :to="{ name: 'product-detail', params: {id: product.id } }">
                                    <button type="button" class="hover:bg-blue-700 bg-blue-600 px-6 py-2 w-full rounded-lg ">
                                        <p class="text-white leading-none font-bold text-sm">See Product</p>
                                    </button>
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- loader spin-->
                <div v-if="loading" class="z-30 flex justify-around relative opacity-25 bg-black inset-0">
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

                <div v-if="product_not_found" class="my-4 flex justify-center text-gray-500">
                    {{ product_not_found }}
                </div>

                <!-- PAGINATION -->
                <div class="flex justify-around items-center mt-16">
                    <pagination :pagination="pagination" @paginate="loadProducts" />
                </div>

            </div>

        </div>
        
    </div>

    <!-- DIV AFTER MODAL SHOW UP -->
    <div v-if="showModalBackground" class="opacity-25 fixed inset-0 z-40 bg-black"></div>

    <footer-component></footer-component>

</div>
</template>

<script>
export default {
    data() {
        return {
            containerProduct: true,
            showModalBackground: false,
            showModalSidebar: false,
            showModalProv: false,
            showModalKab: false,
            showModalCat: false,
            showModalSubCat: false,

            loading: true,
            products: {},

            product_not_found: '',
            currentProducts: 0,
            totalProducts: 0,

            islands: [],
            kabupatens: [],
            categories: [],
            subcategories: [],

            selectingProvinsi: [],
            selectingKabupaten: [],
            selectingCategory: [],
            selectingSubCategory: [],

            isFilteringProvinsi: false,
            isFilteringKabupaten: false,
            isFilteringCategory: false,
            isFilteringSubCategory: false,

            isResetingProvinsi: false,
            isResetingKabupaten: false,
            isResetingCategory: false,
            isResetingSubCategory: false,

            isSelectingProvId: false,
            isSelectingKabId: false,
            isSelectingCatId: false,
            isSelectingSubCatId: false,

            provinsiTerpilih: '',
            categoryTerpilih: '',

            selected: {
                keywords: '',
                selectedProvinsi: [],
                selectedKabupaten: [],
                selectedCategory: [],
                selectedSubCategory: []
            },

            pagination: {},
        }
    },

    created() {
        // this.loadProducts();
    },

    mounted() {
        this.loadProducts();
        this.getTotalProducts();
    },

    computed: {
        stateSearch: function () {
            let keyword =  this.$store.getters['searchProducts/get_keyword'];
            this.selected.keywords = keyword;
        }
    },

    watch: {
        selected: {
            handler: function () {
                this.loadProducts();
            },
            deep: true
        }
    },

    methods: {

        loadProducts: function () {
            let current_page  = this.pagination.current_page;
            let pageNum = current_page ? current_page : 1;
            axios.get(`/api/products?page=${pageNum}`, {
                params: this.selected
            })
            .then((response) => {
                this.loading = false
                this.products = response.data;
                this.pagination = response.data.meta;
                // console.log(response.data);
                this.currentProducts = response.data.data.length;
                if(!response.data.data.length)
                    this.product_not_found = 'product not found';
                else
                    this.product_not_found = '';
                // console.log(`data product sekarang: ${response.data.data.length}`);
            })
            .catch(function (error) {
                console.log(error);
            });
        },

        getTotalProducts(){
            axios.get('/api/total-products')
            .then(res =>{
                console.log(res.data);
                this.totalProducts = res.data.length;
            })
            .catch(err => {
                console.log(err);
            });
        },

        resetFilterProvinsi(){
            this.isResetingProvinsi = true;
            setTimeout(()=> {
                this.isResetingProvinsi = false;
                this.showModalProv = false;
                this.containerProduct = true;
                this.showModalSidebar = false;
                this.showModalBackground = false;
                this.isSelectingProvId = false;

                this.selectingProvinsi = [];
                this.selected.selectedProvinsi = [];
                this.provinsiTerpilih = '';
                this.selectingKabupaten = [];
                this.selected.selectedKabupaten = [];
            },1500);
        },

        resetFilterKabupaten(){
            this.isResetingKabupaten = true;
            setTimeout(()=> {
                this.isResetingKabupaten = false;
                this.showModalKab = false;
                this.containerProduct = true;
                this.showModalSidebar = false;
                this.showModalBackground = false;
                this.isSelectingKabId = false;

                this.selectingKabupaten = [];
                this.selected.selectedKabupaten = [];
            },1500);
        },

        resetFilterCategory(){
            this.isResetingCategory = true;
            setTimeout(()=> {
                this.isResetingCategory = false;
                this.showModalCat = false;
                this.containerProduct = true;
                this.showModalSidebar = false;
                this.showModalBackground = false;
                this.isSelectingCatId = false;

                this.selectingCategory = [];
                this.selected.selectedCategory = [];
                this.categoryTerpilih = '';
                this.selectingSubCategory = [];
                this.selected.selectedSubCategory = [];
            },1500);
        },

        resetFilterSubCategory(){
            this.isResetingSubCategory = true;
            setTimeout(()=> {
                this.isResetingSubCategory = false;
                this.showModalSubCat = false;
                this.containerProduct = true;
                this.showModalSidebar = false;
                this.showModalBackground = false;
                this.isSelectingSubCatId = false;

                this.selectingSubCategory = [];
                this.selected.selectedSubCategory = [];
            },1500);
        },

        applyFilterProvinsi(){
            this.isFilteringProvinsi = true;
            axios.get('/sanctum/csrf-cookie')
            .then(response => {
                this.selected.selectedProvinsi = this.selectingProvinsi;
                setTimeout(()=>{
                    this.isFilteringProvinsi = false;
                    this.showModalProv = false;
                    this.containerProduct = true;
                    this.showModalSidebar = false;
                    this.showModalBackground = false;
                    this.selected.selectedKabupaten = [];
                    this.selectingKabupaten = [];
                },1500);
                // console.log(this.selectedProvinsi);
            }).catch(err => {
                console.log(err);
            });
        },

        applyFilterKabupaten(){
            this.isFilteringKabupaten = true;
            axios.get('/sanctum/csrf-cookie')
            .then(response => {
                this.selected.selectedKabupaten = this.selectingKabupaten;
                setTimeout(()=>{
                    this.isFilteringKabupaten = false;
                    this.showModalKab = false;
                    this.containerProduct = true;
                    this.showModalSidebar = false;
                    this.showModalBackground = false;
                },1500);
                // console.log(this.selectedProvinsi);
            }).catch(err => {
                console.log(err);
            });
        },

        applyFilterCategory(){
            this.isFilteringCategory = true;
            axios.get('/sanctum/csrf-cookie')
            .then(response => {
                this.selected.selectedCategory = this.selectingCategory;
                setTimeout(()=>{
                    this.isFilteringCategory = false;
                    this.showModalCat = false;
                    this.containerProduct = true;
                    this.showModalSidebar = false;
                    this.showModalBackground = false;
                    this.selected.selectedSubCategory = [];
                    this.selectingSubCategory = [];
                },1500);
            }).catch(err => {
                console.log(err);
            });
        },

        applyFilterSubCategory(){
            this.isFilteringSubCategory = true;
            axios.get('/sanctum/csrf-cookie')
            .then(response => {
                this.selected.selectedSubCategory = this.selectingSubCategory;
                setTimeout(()=>{
                    this.isFilteringSubCategory = false;
                    this.showModalSubCat = false;
                    this.containerProduct = true;
                    this.showModalSidebar = false;
                    this.showModalBackground = false;
                },1500);
                // console.log(this.selectedProvinsi);
            }).catch(err => {
                console.log(err);
            });
        },

        handleSelectingProvinsi(param, param2){
            if (this.selectingProvinsi.includes(param) === false)
                this.selectingProvinsi.push(param);
            else 
                alert('sudah dipilih');
            
            //berapapun banyaknya element yg masuk, hapus semua lalu ambil elemen teakhir :-) 
            this.selectingProvinsi.splice(0, this.selectingProvinsi.length -1);
            this.isSelectingProvId = param;
            this.provinsiTerpilih = param2;
        },

        handleSelectingKabupaten(param){
            if (this.selectingKabupaten.includes(param) === false)
                this.selectingKabupaten.push(param);
            else 
                alert('sudah dipilih');
            
            //berapapun banyaknya element yg masuk, hapus semua lalu ambil elemen teakhir :-) 
            this.selectingKabupaten.splice(0, this.selectingKabupaten.length -1);
            this.isSelectingKabId = param;
        },

        handleSelectingCategory(param, param2){
            if (this.selectingCategory.includes(param) === false)
                this.selectingCategory.push(param);
            else 
                alert('sudah dipilih');
            
            //berapapun banyaknya element yg masuk, hapus semua lalu ambil elemen teakhir :-) 
            this.selectingCategory.splice(0, this.selectingCategory.length -1);
            this.isSelectingCatId = param;
            this.categoryTerpilih = param2;
        },

        handleSelectingSubCategory(param){
            if (this.selectingSubCategory.includes(param) === false)
                this.selectingSubCategory.push(param);
            else 
                alert('sudah dipilih');
            
            //berapapun banyaknya element yg masuk, hapus semua lalu ambil elemen teakhir :-) 
            this.selectingSubCategory.splice(0, this.selectingSubCategory.length -1);
            this.isSelectingSubCatId = param;
        },

        provinsiModal: function () {
            axios.get('/sanctum/csrf-cookie')
            .then(response => {
                axios.get('/api/get-island-with-provinsis')
                .then(response => {
                    this.showModalProv = !this.showModalProv;
                    if (this.showModalProv === true) {
                        this.showModalBackground = true;
                        this.showModalSidebar = true;
                        this.containerProduct = false;
                        this.showModalKab = false;
                        this.showModalCat = false;
                        this.showModalSubCat = false;
                        this.islands = response.data;
                        // console.log(this.islands);
                    } else {
                        this.containerProduct = true;
                        this.showModalSidebar = false;
                        this.showModalBackground = false;
                        this.islands = [];
                        console.log(this.islands);
                    }
                })
                .catch(response => {
                    console.log(error);
                });
            })
            .catch(error => {
                console.log(error);
            });
        },

        kabupatenModal: function () {
            axios.get('/sanctum/csrf-cookie')
            .then(response => {
                axios.get('/api/get-kabupatens-by-provinsi-id', {
                    params: {
                        provinsi_id: this.selected.selectedProvinsi
                    }
                })
                .then(response => {
                    this.showModalKab = !this.showModalKab;
                    if (this.showModalKab === true) {
                        this.showModalBackground = true;
                        this.showModalSidebar = true;
                        this.containerProduct = false;
                        this.showModalProv = false;
                        this.showModalCat = false;
                        this.showModalSubCat = false;
                        this.kabupatens = response.data;
                        // console.log(response.data);
                    } else {
                        this.containerProduct = true;
                        this.showModalSidebar = false;
                        this.showModalBackground = false;
                        this.kabupatens = [];
                    }
                })
                .catch(response => {
                    console.log(error);
                });
            })
            .catch(error => {
                console.log(error);
            });
        },

        categoryModal: function () {
            axios.get('/sanctum/csrf-cookie')
            .then(response => {
                axios.get('/api/getcategories')
                .then(response => {
                    this.showModalCat = !this.showModalCat;
                    if (this.showModalCat === true) {
                        this.showModalBackground = true;
                        this.showModalSidebar = true;
                        this.containerProduct = false;
                        this.showModalProv = false;
                        this.showModalKab = false;
                        this.showModalSubCat = false;
                        this.categories = response.data;
                    } else {
                        this.containerProduct = true;
                        this.showModalSidebar = false;
                        this.showModalBackground = false;
                        this.categories = [];
                    }
                })
                .catch(response => {
                    console.log(error);
                });
            })
            .catch(error => {
                console.log(error);
            });
        },

        subcategoryModal: function () {
            axios.get('/sanctum/csrf-cookie')
            .then(response => {
                axios.get('/api/get-subcategories-by-category-id', {
                    params: {
                        category_id: this.selected.selectedCategory
                    }
                })
                .then(response => {
                    this.showModalSubCat = !this.showModalSubCat;
                    if (this.showModalSubCat === true) {
                        this.showModalBackground = true;
                        this.showModalSidebar = true;
                        this.containerProduct = false;
                        this.showModalProv = false;
                        this.showModalKab = false;
                        this.showModalCat = false;
                        this.subcategories = response.data;
                    } else {
                        this.containerProduct = true;
                        this.showModalSidebar = false;
                        this.showModalBackground = false;
                        this.subcategories = [];
                    }
                })
                .catch(response => {
                    console.log(error);
                });
            })
            .catch(error => {
                console.log(error);
            });
        }
        
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
