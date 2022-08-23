<template>
    <main class="my-2">
        <div v-for="(data, key) in aspiration" :key="'aspiration_'+data.id" class="card p-3 rounded-3 mb-2 border-0 border-bottom rounded-0 pb-2">
            <div class="row g-0">
                <div class="col-sm-9 d-flex flex-column">
                    <h6 class="card-title mb-0">{{data.title}}</h6>
                    <p class="card-text module line-clamp">{{removeHTML(data.description)}}</p>
                </div>
                <div class="col-sm-3">
                    <div class="image">
                        <img class="rounded-end" style="width:100%; aspect-ratio: 1/1; object-fit: cover; object-position: center;" :src="URL_STORAGE+'/'+data.photo">
                    </div>
                </div>
            </div>
            <div id="pointer" v-if="key == aspiration.length-1"></div>
        </div>
        <nav class="navbar px-3 bg-white fixed-bottom shadow-lg justify-content-end" style="max-width: 460px; margin: 0 auto">
            <router-link :to="{ name:'report' }" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>
                Aspirasi
            </router-link>
        </nav>
    </main>
</template>
<script>
    import axios from 'axios'
    export default {
        name: "AllAspiration",
        data(){
            return {
                URL_STORAGE:import.meta.env.VITE_URL_STORAGE,
                aspiration:[],
                next:`${import.meta.env.VITE_URL_API}/aspirations`,
                busy:false
            }
        },
        created(){
            this.$watch(
                () => this.$route.params,
                () => {
                    this.getAspiration()
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
            getAspiration(){
                if(this.next && !this.busy){
                    this.busy = true
                    axios.get(this.next).then(response => {
                        this.next = response.data.links.next
                        response.data.data.forEach(p => {
                            this.aspiration.push(p)
                            this.busy = false
                        })
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
                        this.getAspiration()
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