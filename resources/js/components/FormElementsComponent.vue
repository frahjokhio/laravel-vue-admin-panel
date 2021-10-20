<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">All Elements 
                        <div class="pull-right">
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">Add Elements</button></div></div>

                    <div class="card-body">
                       <ul class="list-group">
                            <li class="list-group-item" v-for="e in elements.data">{{e.id}} - {{ e.textfield }} - {{ e.selectfiled }} - {{ e.textarea }} - {{ e.filefield }}
                                <button class="btn-sm btn-primary" data-toggle="modal" data-target="#editModal" >Edit</button>
                            </li>
                       </ul>
                       
                    </div>

                    <div class="card-footer">
                    <pagination :data="elements" @pagination-change-page="getResults"></pagination>
                    <span class="pull-right">footer</span></div>
                </div>
            </div>
        </div>
        <div id="modaldiv">
            <modal-component @recordadded="refreshRecord"></modal-component>
            <edit-modal-component @recordupdated="refreshRecord"></edit-modal-component>
        </div>
    </div>
</template>

<script>
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('modal-component', require('./ModalComponent.vue').default);
Vue.component('edit-modal-component', require('./EditModalComponent.vue').default);
    export default {
        data(){
            return{
                elements:{},
            }
        },
        methods: {
            // Our method to GET results from a Laravel endpoint
            getResults(page = 1) {
                axios.get('http://localhost/adminpanel/elements?page=' + page)
                .then((response) => this.elements = response.data )
                .catch( (error) => console.log(error));
            },
            refreshRecord(response){
                this.elements = response.data
            }
        },
        mounted() {
            axios.get('http://localhost/adminpanel/elements')
            .then((response) => this.elements = response.data )
            .catch( (error) => console.log(error));
            console.log('Component mounted.')
        }
    }
</script>