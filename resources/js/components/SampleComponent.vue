<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Sample Panel Heading</div>

                    <div class="card-body">
                        Panel body {{ name }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Sample Component mounted.')
        },
        data(){
            return{
                name: 'its test'
            }
        }
    }
</script>
