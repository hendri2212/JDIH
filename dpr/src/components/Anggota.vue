<template>
<!-- <div v-for="data in member_of_legislators" :key="'member_of_legislator_'+data.id_user" class="col-4">
                <div class="card" style="overflow:hidden; border:0;">
                    <img :src="'http://127.0.0.1:8000/storage/'+data.photo" style="min-height:183px; height:183px;">
                </div> -->
    <main class="p-3 my-2">
        <h5 class="border-start border-5 border-warning px-2">Anggota DPR</h5>
        <div class="owl-carousel">
            <div v-for="data in member_of_legislators" :key="'member_of_legislator_'+data.id_user" class="" style="width: 140px">
                <img :src="'http://127.0.0.1:8000/storage/'+data.photo" class="rounded-3">
            </div>
        </div>
    </main>
</template>
<script>
    $(document).ready(function(){
        $(".owl-carousel").owlCarousel({
            margin      : 10,
            loop        : true,
            autoWidth   : true,
            items       : 4
        });
    });
    import axios from 'axios'
    export default {
        name: "Anggota",
        data(){
            return {
                member_of_legislators:[]
            }
        },
        created(){
            axios.get("http://127.0.0.1:8000/api/legislator/members").then(response => {
                this.member_of_legislators = response.data
            })
        }
    }
</script>
<style scoped>
    .head-of-section{
        border-left: 6px solid rgb(75, 163, 222);
        padding-left:3px;
        border-top-left-radius: 3px;
    }
</style>
