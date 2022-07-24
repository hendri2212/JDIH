<template>
    <main class="bg-white p-3 my-2">
        <h5 class="border-start border-5 border-warning px-2">Berita Terbaru</h5>
        <div class="owl-carousel">
            <router-link v-for="(data, i) in news" :key="'carousel-news-'+data.id" :to="{ name: 'news' }" class="text-decoration-none text-dark text-wrap" style="width: 270px">
                <img :src="'http://127.0.0.1:8000/storage/'+data.photo" class="rounded-3" style="height: 150px; width: 270px">
                <h6 class="mt-2 lh-base" style="width: 270px">{{data.title}}</h6>
            </router-link>
        </div>
    </main>
</template>
<script>
    $(document).ready(function(){
        $(".owl-carousel").owlCarousel({
            margin      : 10,
            loop        : true,
            autoWidth   : true,
            items       : 3
        });
    });
    import axios from 'axios'
    export default {
        name: "HomeNews",
        data(){
            return {
                news:[]
            }
        },
        created(){
            axios.get("http://127.0.0.1:8000/api/news/newest").then(response => {
                this.news = response.data.data
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
