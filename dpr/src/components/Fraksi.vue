<template>
    <main class="bg-white p-3 my-2">
        <h5 class="border-start border-5 border-warning px-2 text-dark">Fraksi</h5>
        <div class="d-flex flex-wrap text-center">
            <div v-if="!loading" v-for="data in fractions" :key="'fraction_'+data.id_fraction" class="col-3 p-1 border border-end-0 border-bottom-0">
                <img :src="URL_STORAGE+'/'+data.photo" class="img-fluid w-100" style="aspect-ratio: 1;">
            </div>
            <div v-else v-for="n in 8" :key="'fraction_placeholder'+n" class="placeholder-glow col-3 p-1 border border-end-0 border-bottom-0">
                <span class="placeholder placeholder-lg bg-secondary w-100" style="aspect-ratio: 1;"></span>
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
                URL_STORAGE:import.meta.env.VITE_URL_STORAGE,
                fractions:[],
                loading:false
            }
        },
        created(){
            this.loading = true
            axios.get(`${import.meta.env.VITE_URL_API}/fractions`).then(response => {
                this.fractions = response.data
                this.loading=false
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



<!-- <div class="col-3 p-1 border border-end-0 border-bottom-0">
                <img src="@/assets/pdip.svg" class="img-fluid" style="height: 90px">
            </div>
            <div class="col-3 p-1 border border-end-0 border-bottom-0">
                <img src="@/assets/golkar.svg" class="img-fluid" style="height: 90px">
            </div>
            <div class="col-3 p-1 border border-end-0 border-bottom-0">
                <img src="@/assets/pkb.svg" class="img-fluid" style="height: 90px">
            </div>
            <div class="col-3 p-1 border border-bottom-0">
                <img src="@/assets/ppp.svg" class="img-fluid" style="height: 90px">
            </div>
            <div class="col-3 p-1 border border-end-0">
                <img src="@/assets/nasdem.svg" class="img-fluid" style="height: 90px">
            </div>
            <div class="col-3 p-1 border border-end-0">
                <img src="@/assets/gerindra.svg" class="img-fluid" style="height: 90px">
            </div>
            <div class="col-3 p-1 border border-end-0">
                <img src="@/assets/pan.svg" class="img-fluid" style="height: 90px">
            </div>
            <div class="col-3 p-1 border">
                <img src="@/assets/demokrat.svg" class="img-fluid" style="height: 90px">
            </div>
            <div class="col-3 p-1 border border-end-0 border-top-0">
                <img src="@/assets/pks.svg" class="img-fluid" style="height: 90px">
            </div>
            <div class="col-3 p-1 border border-top-0">
                <img src="@/assets/hanura.svg" class="img-fluid" style="height: 90px">
            </div> -->