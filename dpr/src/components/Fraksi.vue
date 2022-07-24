<template>
    <main class="bg-white p-3 my-2">
        <h5 class="head-of-section">Fraksi</h5>
        <div class="d-flex" style="overflow-x: scroll;">
            <div v-for="data in fractions" :key="'fraction_'+data.id_fraction" class="col-3">
                <div style="height:92px; width:92px; overflow:hidden">
                    <img :src="'http://127.0.0.1:8000/storage/'+data.photo" class="h-100">
                </div>
            </div>
        </div>
    </main>
</template>
<script>
    import axios from 'axios'
    export default {
        name: "Fraksi",
        data(){
            return {
                fractions:[]
            }
        },
        created(){
            axios.get("http://127.0.0.1:8000/api/fractions").then(response => {
                this.fractions = response.data
            })
        }
    }
</script>
<style scoped>
    .col-3 {
        margin-bottom:7px;
    }
    .head-of-section{
        border-left: 6px solid rgb(24, 112, 171);
        padding-left:3px;
        border-top-left-radius: 3px;
    }
</style>