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
        }
    },

    // page change by props id (trigered by user click on dropdown profile)
    // watch: {
    //     id: {
    //         handler: function () {
    //             this.loadCompanyDetail();
    //         }
    //     }
    // },

    mounted() {
        this.isloggedIn = localStorage.getItem('isloggedIn');
        this.desa_id = localStorage.getItem('desa_id');
    },

    created() {

    },

    methods: {


        dateFormat(date) {
            return moment(new Date(date)).format('DD/MM/YYYY');
        },

        updateImageList(file) {
            this.imageList.push(file.raw);
            console.log(this.imageList);
        },

        handleRemove(file) {
            this.imageList.splice(file, 1);
        },

        handlePreview(file) {
            this.dialogImageUrl = file.url
            this.dialogVisible = true
        },

        handleExceed(files, imageList) {
            this.$message.warning(`The limit is 5, you have selected ${files.length} files`);
        },

        addProduct(e) {
            e.preventDefault()
            if (!this.validateForm()) {
                return false
            }
            // const that = this
            this.isSubmittingProduct = true;
            const formData = new FormData();

            formData.append('name', this.name);
            formData.append('description', this.description);
            formData.append('sni', this.sni);
            formData.append('nomor_sni', this.nomor_sni);
            formData.append('tkdn', this.tkdn);
            formData.append('nilai_tkdn', this.nilai_tkdn);
            formData.append('nomor_sertifikat_tkdn', this.nomor_sertifikat_tkdn);
            formData.append('nomor_laporan_tkdn', this.nomor_laporan_tkdn);
            formData.append('hs_code', this.hs_code);
            formData.append('price', this.price);
            formData.append('category_id', this.select_category);
            formData.append('subcategory_id', this.select_subcategory);

            this.imageList.forEach(file => {
                formData.append('images[]', file, file.name);
            });

            axios.get('/sanctum/csrf-cookie').then((res1) => {
                console.log(res1)
                axios.post('/api/add-product', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then((res2) => {
                    console.log(res2)
                    this.name = '';
                    this.description = '';
                    this.sni = '';
                    this.nomor_sni = '';
                    this.tkdn = '';
                    this.nilai_tkdn = '';
                    this.nomor_sertifikat_tkdn = '';
                    this.nomor_laporan_tkdn = '';
                    this.hs_code = '';
                    this.price = '';
                    this.select_category = '';
                    this.select_subcategory = '';
                    this.status = true;
                    this.showNotification('Product Successfully Added');
                    this.isSubmittingProduct = false;
                    this.imageList = [];
                }).catch((error) => {
                    console.log(error)
                });
            }).catch((err) => {
                console.log(err)
            });
        },

        validateForm() {
            if (this.imageList.length < 0) {
                this.status = false
                this.showNotification('Image Product cannot be empty')
                return false
            }
            if (!this.name) {
                this.status = false
                this.showNotification('name cannot be empty')
                return false
            }
            if (!this.description) {
                this.status = false
                this.showNotification('description cannot be empty')
                return false
            }
            if (!this.nomor_sertifikat_tkdn) {
                this.status = false
                this.showNotification('nomor sertifikat tkdn cannot be empty')
                return false
            }
            if (!this.nomor_laporan_tkdn) {
                this.status = false
                this.showNotification('nomor laporan tkdn cannot be empty')
                return false
            }
            if (!this.hs_code) {
                this.status = false
                this.showNotification('hs code cannot be empty')
                return false
            }
            return true
        },

        showNotification(message) {
            this.status_msg = message
            setTimeout(() => {
                this.status_msg = ''
            }, 2000)
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

input:checked+svg {
    display: block;
}

/*
.el-upload--picture-card {
    background-color: #fbfdff;
    border: 1px dashed #c0ccda;
    border-radius: 6px;
    box-sizing: border-box;
    width: 4rem;
    height: 4rem;
    line-height: 74px;
    vertical-align: top;
}

.el-upload-list--picture-card .el-upload-list__item {
    overflow: hidden;
    background-color: #fff;
    border: 1px solid #c0ccda;
    border-radius: 6px;
    box-sizing: border-box;
    width: 4rem;
    height: 4rem;
    margin: 0 8px 8px 0;
    display: inline-block;
}*/
</style>
