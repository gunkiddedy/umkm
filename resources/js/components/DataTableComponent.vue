<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Laravel Vue Datatables Component Example - Tutsmake.com</div>
   
                    <div class="card-body">
                        <datatable :columns="columns" :data="rows"></datatable>
                        <datatable-pager v-model="page" type="abbreviated" :per-page="per_page"></datatable-pager>
   
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
   
<script>
   
    import DatatableFactory from 'vuejs-datatable';
   
    export default {
        components: { DatatableFactory },
        mounted() {
            console.log('Component mounted.');
            this.isloggedIn = localStorage.getItem('isloggedIn');
            this.desa_id = localStorage.getItem('desa_id');
        },
        data(){
            return {
                columns: [
                        {label: 'id', field: 'id'}, 
                        {label: 'Title', field: 'nama_usaha'},
                        {label: 'Slug', field: 'email'}
                    ],
                rows: [],
                page: 1,
                per_page: 10,
            }
        },
        methods:{
            getPosts: function() {
                axios.get('/api/ukms/').then(function(response){
                    this.rows = response.data;
                }.bind(this));
            }
        },
        created: function(){
            this.getPosts()
        }
    }
</script>