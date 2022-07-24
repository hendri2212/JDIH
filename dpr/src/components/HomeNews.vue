<template>
    <main class="bg-white p-3 my-2">
        <h5 class="head-of-section">Berita Terbaru</h5>
        <div class="carouselku">
            <div v-for="data in news" :key="'carouselku-news-'+data.id" class="slick-slide">
                <img :src="'http://127.0.0.1:8000/storage/'+data.photo">
            </div>
        </div>
        <div id="carouselExampleCaptions" class="carousel slide my-3" data-bs-ride="false">
            <!-- <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div> -->
            <div class="carousel-inner">
                <div v-for="(data, i) in news" :key="'carousel-news-'+data.id" class="carousel-item" :class="i == 0 ? 'active' : ''">
                    <img :src="'http://127.0.0.1:8000/storage/'+data.photo" class="d-block w-100" :alt="data.title" style="height:214px;">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>{{data.title}}</h5>
                        <p class="text-truncate">
                            {{removeHTML(data.content)}}
                        </p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </main>
</template>
<script>
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
</style>