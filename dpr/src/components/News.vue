<template>
    <main class="bg-white p-3 my-2" v-if="news">
        <h5 class="mb-0">{{news.title}}</h5>
        <p class="muted fw-lighter">{{news.author.name}} | {{news.created_at}}</p>
        <img :src="URL_STORAGE+'/'+news.photo" class="img-fluid">
        <div class="mt-2 lh-base content" v-html="news.content">

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
                    this.news = null
                    let slug = this.$route.params.slug
                    axios.get(`${import.meta.env.VITE_URL_API}/news/${slug}`).then(response => {
                        this.news = response.data.data
                    }).catch(({response}) => {
                        this.$router.replace({name:'home'})
                    })
                },
                // fetch the data when the view is created and the data is
                // already being observed
                { immediate: true }
            )
        }
    }
</script>
<style scoped>
    
    .content ::v-deep(p) {
        margin-bottom:0 !important;
    }
</style>