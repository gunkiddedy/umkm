<template>
<div>
    <div class="px-16 bg-gray-100">
        <header-component></header-component>
        <div class="flex px-4 py-4 mt-4">
            <transition name="fade">
                <div class="w-full">
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
                    
                    <!-- dttb-->
                    <div>
                        <vue-good-table
                            mode="remote"
                            @on-page-change="onPageChange"
                            @on-sort-change="onSortChange"
                            @on-column-filter="onColumnFilter"
                            @on-per-page-change="onPerPageChange"
                            @on-search="onSearch"
                            :totalRows="totalRecords"
                            :isLoading.sync="isLoading"
                            :pagination-options="{
                                enabled: true,
                            }"
                            :rows="rows"
                            :columns="columns"
                            :globalSearch="true"
                            :search-options="{
                                enabled: true,
                                skipDiacritics: true,
                                trigger: 'enter',
                                placeholder: 'Cari data...',
                            }"
                        />

                    </div>
                    <!-- -->
                    
                </div>
            </transition>
        </div>
    </div>
    <footer-component></footer-component>
</div>
</template>

<script>
import _ from 'lodash';
export default {
    props: ['id'],
    data() {
        return {
            loading: true,

            dialogImageUrl: '',
            dialogVisible: false,
            isSubmittingProduct: false,
            isUpdatingInfo: false,
            status_msg: '',
            status: '',

            isloggedIn: 'false',
            desa_id: '',

            isLoading: false,
            columns: [
                {label: 'Id',field: 'id',width: '20px', sortable: true},
                {
                    label: 'Nama Usaha',
                    field: 'nama_usaha', 
                    sortable: true, 
                    width: '200px',
                },
                {
                    label: 'kelembagaan', 
                    field: 'kelembagaan', 
                    sortable: true, 
                    width: '250px',
                    filterOptions: {
                        enabled: true, // enable filter for this column
                        placeholder: 'Filter Kelembagaan', // placeholder for filter input
                        //filterValue: 'Jane', // initial populated value for this filter
                        filterDropdownItems: [
                            'PT', 'CV', 'Koperasi', 
                            'FA', 'UD', 'P. Perseorangan Lainnya', 
                            'Non Badan Hukum'], // dropdown (with selected values) instead of text input
                        //filterFn: this.columnFilterFn, //custom filter function that
                        trigger: 'enter', //only trigger on enter not on keyup 
                    },
                },
                {label: 'nama_pemilik',field: 'nama_pemilik', sortable: true, width: '200px'},
                {label: 'nik',field: 'nik', sortable: true, width: 'auto'},
                {label: 'L/P',field: 'jenis_kelamin', width: '50px', sortable: true},
                {label: 'siu',field: 'siu', sortable: true, width: 'auto'},
                {label: 'npwp',field: 'npwp', sortable: true, width: 'auto'},
                {label: 'tmu',field: 'tmu', sortable: true, width: 'auto'},
                {label: 'alamat',field: 'alamat', sortable: true, width: '200px'},
                {label: 'desa',field: 'desa', sortable: true, width: '150px'},
                {label: 'tlp',field: 'tlp', sortable: true, width: 'auto'},
                {label: 'email',field: 'email', sortable: true, width: 'auto'},
                {label: 'up1',field: 'up1', sortable: true, width: 'auto'},
                {label: 'up2',field: 'up2', sortable: true, width: 'auto'},
                {label: 'up3',field: 'up3', sortable: true, width: 'auto'},
                {label: 'up4',field: 'up4', sortable: true, width: 'auto'},
                {label: 'up5',field: 'up5', sortable: true, width: 'auto'},
                {label: 'bahan_baku',field: 'bahan_baku', sortable: true, width: '200px'},
                {label: 'tk1_l',field: 'tk1_l', sortable: true, width: 'auto'},
                {label: 'tk1_p',field: 'tk1_p', sortable: true, width: 'auto'},
                {label: 'tk2_l',field: 'tk2_l', sortable: true, width: 'auto'},
                {label: 'tk2_p',field: 'tk2_p', sortable: true, width: 'auto'},
                {label: 'kp1',field: 'kp1', sortable: true, width: 'auto'},
                {label: 'kp2',field: 'kp2', sortable: true, width: 'auto'},
                {label: 'omset1',field: 'omset1', sortable: true, width: '150px'},
                {label: 'omset2',field: 'omset2', sortable: true, width: '150px'},
                {label: 'ms1',field: 'ms1', sortable: true, width: 'auto'},
                {label: 'ms2',field: 'ms2', sortable: true, width: 'auto'},
                {label: 'bp1',field: 'bp1', sortable: true, width: 'auto'},
                {label: 'bp2',field: 'bp2', sortable: true, width: 'auto'},
                {label: 'pk1',field: 'pk1', sortable: true, width: 'auto'},
                {label: 'pk2',field: 'pk2', sortable: true, width: 'auto'},
                {label: 'pp1',field: 'pp1', sortable: true, width: 'auto'},
                {label: 'pp2',field: 'pp2', sortable: true, width: 'auto'},
                {label: 'pb1',field: 'pb1', sortable: true, width: 'auto'},
                {label: 'pb2',field: 'pb2', sortable: true, width: 'auto'},
                {label: 'kriteria',field: 'kriteria', sortable: true, width: '200px'},
                {label: 'tahun',field: 'tahun', sortable: true, width: 'auto'},
            ],
            rows: [],
            totalRecords: 0,
            ukmDesa: {
                searchTerm: '',
                page: 1, 
                per_page: 15
            }
        }
    },

    mounted() {
        this.isloggedIn = localStorage.getItem('isloggedIn');
        this.desa_id = localStorage.getItem('desa_id');
        this.getRecords();
    },

    methods: {

        onSearch: _.debounce(function (params) {
            this.updateParams(params);
            this.getRecords();
            return false;
        }, 500),

        updateParams(newProps) {
            this.ukmDesa = Object.assign({}, this.ukmDesa, newProps);
        },
        
        onPageChange(params) {
            this.updateParams({page: params.currentPage});
            this.getRecords();
        },

        onPerPageChange(params) {
            this.updateParams({perPage: params.currentPerPage});
            this.getRecords();
        },

        onSortChange(params) {
            this.updateParams({
                sort: [{
                    type: params.sortType,
                    field: this.columns.field,
                }],
            });
            this.getRecords();
        },
        // this.columns[params.columnIndex]
        onColumnFilter(params) {
            this.updateParams(params);
            this.getRecords();
        },

        // load items is what brings back the rows from server
        getRecords() {
            axios.get('/api/ukms/'+this.desa_id+'?page='+this.ukmDesa.page+'&searchTerm='+this.ukmDesa.searchTerm)
            .then(response => {
                this.loading = false;
                this.totalRecords = response.data.total;
                this.rows = response.data.data;
                console.log(response.data);
            })
            .catch(err => {
                console.log(err);
            })
        },

        // getDataUkmDesa(){
        //     axios.get('/api/ukms/' + this.desa_id)
        //     .then(res => {
        //         this.loading = false;
        //         this.pagination = res.data.meta;
        //         this.dataUkmDesa = res.data;
        //         console.log(res.data);
        //     })
        //     .catch(err => {
        //         console.log(err);
        //     })
        // },

        // dateFormat(date) {
        //     return moment(new Date(date)).format('DD/MM/YYYY');
        // },
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

input:checked+svg {
    display: block;
}
</style>
