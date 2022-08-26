<template>
    <main class="bg-white p-3 my-2 text-dark" v-if="news">
        <h5 class="mb-0">{{news.title}}</h5>
        <p class="muted fw-lighter">{{news.author.name}} | {{((new Date(news.created_at).getMonth() > 8) ? (new Date(news.created_at).getMonth() + 1) : ('0' + (new Date(news.created_at).getMonth() + 1))) + '/' + ((new Date(news.created_at).getDate() > 9) ? new Date(news.created_at).getDate() : ('0' + new Date(news.created_at).getDate())) + '/' + new Date(news.created_at).getFullYear()}}</p>
        <img :src="URL_STORAGE+'/'+news.photo" style="border-radius:7px;" class="img-fluid">
        <div class="mt-2 lh-base content" style="overflow-wrap: break-word" v-html="news.content">

        </div>
    </main>
    <main class="bg-white p-3 my-2 placeholder-glow" v-else>
        <h5 class="mb-0 col-12 placeholder bg-secondary rounded-1"></h5>
        <p class="muted fw-lighter">
            <span class="col-2 placeholder bg-secondary rounded-1"></span>
            |
            <span class="col-2 placeholder bg-secondary rounded-1"></span>
        </p>
        <span class="col-12 placeholder bg-secondary rounded-1" style="height:201px;"></span>
        <p class="mt-2 lh-base placeholder bg-secondary rounded-1 col-11"></p>
        <p class="lh-base placeholder bg-secondary rounded-1 col-9"></p>
        <p class="lh-base placeholder bg-secondary rounded-1 col-6"></p>
    </main>
</template>
<script>
    import axios from 'axios'
    export default {
        name: "News",
        data(){
            return {
                URL_STORAGE:import.meta.env.VITE_URL_STORAGE,
                news:null
            }
        },
        created(){
            this.$watch(
                () => this.$route.params,
                () => {
                    if(this.$route.params.hasOwnProperty('slug')){
                        this.news = null
                        let slug = this.$route.params.slug
                        axios.get(`${import.meta.env.VITE_URL_API}/news/${slug}`).then(response => {
                            this.news = response.data.data
                        }).catch(({response}) => {
                            this.$router.replace({name:'home'})
                        })
                    }
                },
                { immediate: true }
            )
        },
        methods:{
            getNews(){
                
            }
        }
    }
</script>