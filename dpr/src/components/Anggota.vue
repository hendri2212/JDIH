<template>
<!-- <div v-for="data in member_of_legislators" :key="'member_of_legislator_'+data.id_user" class="col-4">
                <div class="card" style="overflow:hidden; border:0;">
                    <img :src="'import.meta\u200b.env.VITE_URL_STORAGE'+'/'+data.photo" style="min-height:183px; height:183px;">
                </div> -->
    <main class="p-3 my-2" id="anggota">
        <h5 class="border-start border-5 border-warning px-2">Anggota DPR</h5>
        <div v-if="member_of_legislators.length > 0" class="owl-carousel owl-carousel-legislator">
            <div v-for="(data, i) in member_of_legislators" :key="'carousel-legislator-'+data.id" style="width: 170px">
                <img :src="URL_STORAGE+'/'+data.photo" class="rounded-3">
            </div>
        </div>
        <div v-else class="placeholder-glow d-flex overflow-hidden">
            <div>
                <div class="placeholder bg-secondary rounded-1" style="width:170px; height:255px;"></div>
            </div>
            <div class="ms-2">
                <div class="placeholder bg-secondary rounded-1" style="width:170px; height:255px;"></div>
            </div>
            <div class="ms-2">
                <div class="placeholder bg-secondary rounded-1" style="width:170px; height:255px;"></div>
            </div>
        </div>
    </main>
</template>
<script>
    import axios from 'axios'
    export default {
        name: "Anggota",
        data(){
            return {
                URL_STORAGE:import.meta.env.VITE_URL_STORAGE,
                member_of_legislators:[]
            }
        },
        created(){
            axios.get(`${import.meta.env.VITE_URL_API}/legislator/members`).then(response => {
                this.member_of_legislators = response.data
                $(document).ready(function(){
                    $(".owl-carousel-legislator").owlCarousel({
                        margin      : 10,
                        loop        : true,
                        autoWidth   : true,
                        items       : 4
                    });
                });
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
