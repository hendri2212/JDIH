<template>
    <main class="bg-white p-3 my-2">
        <h5 class="border-start border-5 border-warning px-2">Berita Terbaru</h5>
        <div v-if="!loading" class="owl-carousel owl-carousel-news">
            <router-link v-for="(data, i) in news" :key="'carousel-news-'+data.id" :to="{ name: 'news', params:{slug:data.slug} }" class="text-decoration-none text-dark text-wrap" style="width: 270px">
                <img :src="URL_STORAGE+'/'+data.banner" class="rounded-3" style="max-width: 270px">
                <h6 class="mt-2 lh-base" style="width: 270px">{{data.title}}</h6>
            </router-link>
        </div>
        <div v-else class="placeholder-glow d-flex overflow-hidden">
            <div v-for="n in 2" :key="'placeholder'+n" :class="n!=0 ? 'ms-2' : ''">
                <div class="placeholder bg-secondary rounded-1" style="width:270px; aspect-ratio: 3/2;"></div>
                <h6 class="mt-2 placeholder bg-secondary d-block col-3 rounded-1"></h6>
            </div>
        </div>
    </main>
</template>
<script>
    import axios from 'axios'
    export default {
        name: "HomeNews",
        data(){
            return {
                URL_STORAGE:import.meta.env.VITE_URL_STORAGE,
                loading:false,
                news:[]
            }
        },
        async created(){
            this.loading = true
            await axios.get(`${import.meta.env.VITE_URL_API}/news/newest`).then(response => {
                this.news = response.data.data
                $(document).ready(function(){
                    $(".owl-carousel-news").owlCarousel({
                        margin      : 10,
                        loop        : true,
                        autoWidth   : true,
                        items       : response.data.data.length
                    })
                });
                this.loading = false
            })
        },
        methods:{
            removeHTML(str){ 
                var tmp = document.createElement("DIV");
                tmp.innerHTML = str;
                return tmp.textContent || tmp.innerText || "";
            }
        }
    }
</script>
<style scoped>
    .head-of-section{
        border-left: 6px solid rgb(227, 68, 103);
        padding-left:3px;
        border-top-left-radius: 3px;
    }
</style> -->
