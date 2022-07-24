<template>
    <main class="bg-white p-3 my-2">
        <h5 class="border-start border-5 border-warning px-2">Semua Berita</h5>
        <div v-for="data in news" :key="'news_'+data.id_news" class="card mb-3 border-0 border-bottom rounded-0 pb-2">
            <div class="row g-0">
                <div class="col-3">
                    <img :src="'http://127.0.0.1:8000/storage/'+data.photo" class="img-fluid rounded-start" style="padding-right: 5px">
                </div>
                <div class="col-9">
                    <div class="card-body p-0">
                        <h5 class="card-title mb-0 text-truncate">{{data.title}}</h5>
                        <p class="card-text module line-clamp">{{removeHTML(data.content)}}</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>
<script>
    import axios from 'axios'
    export default {
        name: "AllNews",
        data(){
            return {
                news:[]
            }
        },
        created(){
            axios.get("http://127.0.0.1:8000/api/news").then(response => {
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
    .module {
        overflow: hidden;
    }
    .line-clamp {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;  
    }
    .head-of-section{
        border-left: 6px solid rgb(242, 140, 61);
        padding-left:3px;
        border-top-left-radius: 3px;
    }

</style>