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
                            mode="pages"
                            @on-page-change="onPageChange"
                            @on-sort-change="onSortChange"
                            @on-column-filter="onColumnFilter"
                            @on-per-page-change="onPerPageChange"
                            paginate="true"
                            :lineNumbers="true"
                            :totalRows="totalRecords"
                            :isLoading.sync="isLoading"
                            :pagination-options="{
                                enabled: true,
                                nextLabel: 'maju',
                                prevLabel: 'mundur',
                                setCurrentPage: 1,
                                perPage: 15,
                                perPageDropdown: [15, 30, 45, 60],
                                dropdownAllowAll: true,
                                rowsPerPageLabel: 'per halaman',
                                allLabel: 'Semua',
                                ofLabel: 'dari',
                            }"
                            :rows="rows"
                            :columns="columns"
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
                {
                    label: 'Nama Usaha',
                    field: 'nama_usaha', 
                    width: '200px',
                    filterOptions: {
                        enabled: true, // enable filter for this column
                        placeholder: 'Filter', // placeholder for filter input
                        // filterValue: "",
                        // filterDropdownItems: [],
                        // filterFn: function(data, filterString) {
                        //     return data === filterString;
                        // },
                        trigger: 'enter', //only trigger on enter not on keyup
                    },
                },
                {
                    label: 'kelembagaan', 
                    field: 'kelembagaan', 
                    width: '250px',
                    filterOptions: {
                        enabled: true, // enable filter for this column
                        placeholder: 'Filter', // placeholder for filter input
                        // filterValue: "",
                        filterDropdownItems: [
                            'PT', 'CV', 'Koperasi', 
                            'FA', 'UD', 'P. Perseorangan Lainnya', 
                            'Non Badan Hukum'
                        ],
                        // filterFn: function(data, filterString) {
                        //     return data === filterString;
                        // },
                        trigger: 'keyup',
                    },
                },
                {label: 'nama_pemilik',field: 'nama_pemilik', sortable: true, width: '200px',filterable: true,
                    filterOptions: {
                        enabled: true, // enable filter for this column
                        placeholder: 'Filter', // placeholder for filter input
                        trigger: 'enter', //only trigger on enter not on keyup
                    },
                },
                {label: 'nik',field: 'nik', sortable: true, width: 'auto', filterable: true,filterOptions: {
                        enabled: true, // enable filter for this column
                        placeholder: 'Filter', // placeholder for filter input
                        trigger: 'enter', //only trigger on enter not on keyup
                    },},
                {label: 'L/P',field: 'jenis_kelamin', width: '50px', sortable: true, filterable: true,filterOptions: {
                        enabled: true, // enable filter for this column
                        placeholder: 'Filter', // placeholder for filter input
                        trigger: 'enter', //only trigger on enter not on keyup
                    },},
                {label: 'siu',field: 'siu', sortable: true, width: 'auto', filterable: true, filterOptions: {
                        enabled: true, // enable filter for this column
                        placeholder: 'Filter', // placeholder for filter input
                        trigger: 'enter', //only trigger on enter not on keyup
                    },},
                {label: 'npwp',field: 'npwp', sortable: true, width: 'auto', filterable: true, filterOptions: {
                        enabled: true, // enable filter for this column
                        placeholder: 'Filter', // placeholder for filter input
                        trigger: 'enter', //only trigger on enter not on keyup
                    },},
                {label: 'tmu',field: 'tmu', sortable: true, width: 'auto', filterable: true, filterOptions: {
                        enabled: true, // enable filter for this column
                        placeholder: 'Filter', // placeholder for filter input
                        trigger: 'enter', //only trigger on enter not on keyup
                    },},
                {label: 'alamat',field: 'alamat', sortable: true, width: '200px', filterable: true, filterOptions: {
                        enabled: true, // enable filter for this column
                        placeholder: 'Filter', // placeholder for filter input
                        trigger: 'enter', //only trigger on enter not on keyup
                    },},
                {label: 'desa',field: 'desa', sortable: true, width: '150px', filterable: true, filterOptions: {
                        enabled: true, // enable filter for this column
                        placeholder: 'Filter', // placeholder for filter input
                        trigger: 'enter', //only trigger on enter not on keyup
                    },},
                {label: 'tlp',field: 'tlp', sortable: true, width: 'auto', filterable: true, filterOptions: {
                        enabled: true, // enable filter for this column
                        placeholder: 'Filter', // placeholder for filter input
                        trigger: 'enter', //only trigger on enter not on keyup
                    },},
                {label: 'email',field: 'email', sortable: true, width: 'auto', filterable: true, filterOptions: {
                        enabled: true, // enable filter for this column
                        placeholder: 'Filter', // placeholder for filter input
                        trigger: 'enter', //only trigger on enter not on keyup
                    },},
                {label: 'up1',field: 'up1', sortable: true, width: 'auto', filterable: true, filterOptions: {
                        enabled: true, // enable filter for this column
                        placeholder: 'Filter', // placeholder for filter input
                        trigger: 'enter', //only trigger on enter not on keyup
                    },},
                {label: 'up2',field: 'up2', sortable: true, width: 'auto', filterable: true, filterOptions: {
                        enabled: true, // enable filter for this column
                        placeholder: 'Filter', // placeholder for filter input
                        trigger: 'enter', //only trigger on enter not on keyup
                    },},
                {label: 'up3',field: 'up3', sortable: true, width: 'auto', filterable: true, filterOptions: {
                        enabled: true, // enable filter for this column
                        placeholder: 'Filter', // placeholder for filter input
                        trigger: 'enter', //only trigger on enter not on keyup
                    },},
                {label: 'up4',field: 'up4', sortable: true, width: 'auto', filterable: true, filterOptions: {
                        enabled: true, // enable filter for this column
                        placeholder: 'Filter', // placeholder for filter input
                        trigger: 'enter', //only trigger on enter not on keyup
                    },},
                {label: 'up5',field: 'up5', sortable: true, width: 'auto', filterable: true, filterOptions: {
                        enabled: true, // enable filter for this column
                        placeholder: 'Filter', // placeholder for filter input
                        trigger: 'enter', //only trigger on enter not on keyup
                    },},
                {label: 'bahan_baku',field: 'bahan_baku', sortable: true, width: '200px', filterable: true, filterOptions: {
                        enabled: true, // enable filter for this column
                        placeholder: 'Filter', // placeholder for filter input
                        trigger: 'enter', //only trigger on enter not on keyup
                    },},
                {label: 'tk1_l',field: 'tk1_l', sortable: true, width: 'auto', filterable: true, filterOptions: {
                        enabled: true, // enable filter for this column
                        placeholder: 'Filter', // placeholder for filter input
                        trigger: 'enter', //only trigger on enter not on keyup
                    },},
                {label: 'tk1_p',field: 'tk1_p', sortable: true, width: 'auto', filterable: true, filterOptions: {
                        enabled: true, // enable filter for this column
                        placeholder: 'Filter', // placeholder for filter input
                        trigger: 'enter', //only trigger on enter not on keyup
                    },},
                {label: 'tk2_l',field: 'tk2_l', sortable: true, width: 'auto', filterable: true, filterOptions: {
                        enabled: true, // enable filter for this column
                        placeholder: 'Filter', // placeholder for filter input
                        trigger: 'enter', //only trigger on enter not on keyup
                    },},
                {label: 'tk2_p',field: 'tk2_p', sortable: true, width: 'auto', filterable: true, filterOptions: {
                        enabled: true, // enable filter for this column
                        placeholder: 'Filter', // placeholder for filter input
                        trigger: 'enter', //only trigger on enter not on keyup
                    },},
                {label: 'kp1',field: 'kp1', sortable: true, width: 'auto', filterable: true, filterOptions: {
                        enabled: true, // enable filter for this column
                        placeholder: 'Filter', // placeholder for filter input
                        trigger: 'enter', //only trigger on enter not on keyup
                    },},
                {label: 'kp2',field: 'kp2', sortable: true, width: 'auto', filterable: true, filterOptions: {
                        enabled: true, // enable filter for this column
                        placeholder: 'Filter', // placeholder for filter input
                        trigger: 'enter', //only trigger on enter not on keyup
                    },},
                {label: 'omset1',field: 'omset1', sortable: true, width: '150px', filterable: true, filterOptions: {
                        enabled: true, // enable filter for this column
                        placeholder: 'Filter', // placeholder for filter input
                        trigger: 'enter', //only trigger on enter not on keyup
                    },},
                {label: 'omset2',field: 'omset2', sortable: true, width: '150px', filterable: true, filterOptions: {
                        enabled: true, // enable filter for this column
                        placeholder: 'Filter', // placeholder for filter input
                        trigger: 'enter', //only trigger on enter not on keyup
                    },},
                {label: 'ms1',field: 'ms1', sortable: true, width: 'auto', filterable: true, filterOptions: {
                        enabled: true, // enable filter for this column
                        placeholder: 'Filter', // placeholder for filter input
                        trigger: 'enter', //only trigger on enter not on keyup
                    },},
                {label: 'ms2',field: 'ms2', sortable: true, width: 'auto', filterable: true, filterOptions: {
                        enabled: true, // enable filter for this column
                        placeholder: 'Filter', // placeholder for filter input
                        trigger: 'enter', //only trigger on enter not on keyup
                    },},
                {label: 'bp1',field: 'bp1', sortable: true, width: 'auto', filterable: true, filterOptions: {
                        enabled: true, // enable filter for this column
                        placeholder: 'Filter', // placeholder for filter input
                        trigger: 'enter', //only trigger on enter not on keyup
                    },},
                {label: 'bp2',field: 'bp2', sortable: true, width: 'auto', filterable: true, filterOptions: {
                        enabled: true, // enable filter for this column
                        placeholder: 'Filter', // placeholder for filter input
                        trigger: 'enter', //only trigger on enter not on keyup
                    },},
                {label: 'pk1',field: 'pk1', sortable: true, width: 'auto', filterable: true, filterOptions: {
                        enabled: true, // enable filter for this column
                        placeholder: 'Filter', // placeholder for filter input
                        trigger: 'enter', //only trigger on enter not on keyup
                    },},
                {label: 'pk2',field: 'pk2', sortable: true, width: 'auto', filterable: true, filterOptions: {
                        enabled: true, // enable filter for this column
                        placeholder: 'Filter', // placeholder for filter input
                        trigger: 'enter', //only trigger on enter not on keyup
                    },},
                {label: 'pp1',field: 'pp1', sortable: true, width: 'auto', filterable: true, filterOptions: {
                        enabled: true, // enable filter for this column
                        placeholder: 'Filter', // placeholder for filter input
                        trigger: 'enter', //only trigger on enter not on keyup
                    },},
                {label: 'pp2',field: 'pp2', sortable: true, width: 'auto', filterable: true, filterOptions: {
                        enabled: true, // enable filter for this column
                        placeholder: 'Filter', // placeholder for filter input
                        trigger: 'enter', //only trigger on enter not on keyup
                    },},
                {label: 'pb1',field: 'pb1', sortable: true, width: 'auto', filterable: true, filterOptions: {
                        enabled: true, // enable filter for this column
                        placeholder: 'Filter', // placeholder for filter input
                        trigger: 'enter', //only trigger on enter not on keyup
                    },},
                {label: 'pb2',field: 'pb2', sortable: true, width: 'auto', filterable: true, filterOptions: {
                        enabled: true, // enable filter for this column
                        placeholder: 'Filter', // placeholder for filter input
                        trigger: 'enter', //only trigger on enter not on keyup
                    },},
                {label: 'kriteria',field: 'kriteria', sortable: true, width: '200px', filterable: true, filterOptions: {
                        enabled: true, // enable filter for this column
                        placeholder: 'Filter', // placeholder for filter input
                        trigger: 'enter', //only trigger on enter not on keyup
                    },},
                {label: 'tahun',field: 'tahun', sortable: true, width: 'auto', filterable: true, filterOptions: {
                        enabled: true, // enable filter for this column
                        placeholder: 'Filter', // placeholder for filter input
                        trigger: 'enter', //only trigger on enter not on keyup
                    },},
            ],
            rows: [],
            totalRecords: 0,
            serverParams: {
                columnFilters: {},
                sort: {
                    field: '', 
                    type: '',
                },
                page: 1,
                perPage: 15,
            },
        }
    },

    mounted() {
        this.isloggedIn = localStorage.getItem('isloggedIn');
        this.desa_id = localStorage.getItem('desa_id');
        this.getRecords();
    },

    methods: {

        updateParams(newProps) {
            this.serverParams = Object.assign({}, this.serverParams, newProps);
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
                field: this.columns[params.columnIndex].field,
                }],
            });
            this.getRecords();
        },
        // this.columns[params.columnIndex]
        onColumnFilter(params) {
            // this.updateParams(params);
            this.$set(this.columns[foundIndex].filterOptions, 'filterValue', value);
            this.getRecords();
        },
        // load items is what brings back the rows from server
        getRecords() {
            axios.get('/api/ukms/'+this.desa_id, {params: this.serverParams})
            .then(response => {
                this.loading = false;
                this.totalRecords = response.data.total;
                // this.totalRecords = response.totalRecords;
                this.rows = response.data.data;
                // this.rows = response.rows;
                console.log(response.data);
            })
            .catch(err => {
                console.log(err);
            })
        },

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
