<template>
    <main class="bg-white p-3 my-2" id="news">
        <h5 class="border-start border-5 border-warning px-2">Semua Berita</h5>
        <router-link v-for="(data, key) in news" :key="'news_'+data.id" :to="{ name: 'news', params:{slug:data.slug} }" class="card mb-3 border-0 border-bottom rounded-0 pb-2 text-decoration-none text-black">
            <div class="row g-0">
                <div class="col-3" style="padding-right: 16px;">
                    <div class="image">
                        <img style="width:100%; aspect-ratio: 1/1; border-radius: 7px;" :src="URL_STORAGE+'/'+data.thumbnail" >
                    </div>
                </div>
                <div class="col-9 d-flex flex-column">
                    <h6 class="card-title mb-0">{{data.title}}</h6>
                    <!-- <p class="card-text module line-clamp">{{removeHTML(data.content)}}</p> -->
                </div>
            </div>
            <div id="pointer" v-if="key == news.length-1"></div> 
        </router-link>
        <div v-if="busy" v-for="n in 3" :key="'news_placeholder_'+n" class="card mb-3 border-0 border-bottom rounded-0 pb-2 text-decoration-none text-black placeholder-glow">
            <div class="row">
                <div class="col-3" style="padding-right: 16px;">
                    <span class="placeholder placeholder-lg bg-secondary" style="width:100%; aspect-ratio: 1/1; border-radius: 7px;"></span>
                </div>
                <div class="col-9 d-flex flex-column">
                    <h6 class="card-title mb-0 placeholder bg-secondary mb-3"></h6>
                    <h6 class="card-title mb-0 placeholder bg-secondary mb-3"></h6>
                    <h6 class="card-title mb-0 placeholder bg-secondary"></h6>
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
                URL_STORAGE:import.meta.env.VITE_URL_STORAGE,
                news:[],
                next:`${import.meta.env.VITE_URL_API}/news`,
                busy:false
            }
        },
        created(){
            this.$watch(
                () => this.$route.params,
                () => {
                    this.getNews()
                    window.addEventListener('scroll', this.handleScroll);
                },
                // fetch the data when the view is created and the data is
                // already being observed
                { immediate: true }
            )
        },
        destroyed () {
            window.removeEventListener('scroll', this.handleScroll);
        },
        methods:{
            getNews(){
                if(this.next && !this.busy){
                    this.busy = true
                    axios.get(this.next).then(response => {
                        this.next = response.data.links.next
                        response.data.data.forEach(p => {
                            this.news.push(p)
                        })
                        this.busy = false
                    })
                }
            },
            handleScroll (event) {
                if(document.getElementById("pointer")){
                    const {
                        scrollTop,
                        clientHeight,
                    } = document.documentElement;
                    let scrollPos = Math.floor(scrollTop+clientHeight)
                    let pointer = Math.floor(document.getElementById("pointer").getBoundingClientRect().top + window.scrollY)
                    if(scrollPos >= pointer-5){
                        // document.getElementById("pointer").remove()
                        this.getNews()
                    }
                }
            },
            removeHTML(str){ 
                var tmp = document.createElement("DIV");
                tmp.innerHTML = str;
                return tmp.textContent || tmp.innerText || "";
            }
        }
    }
</script>
<style scoped>
    *, ::before, ::after {
        box-sizing: border-box;
    }
    .module {
        overflow: hidden;
    }
    .line-clamp {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;  
    }
    .head-of-section{
        border-left: 6px solid rgb(242, 140, 61);
        padding-left:3px;
        border-top-left-radius: 3px;
    }

</style>