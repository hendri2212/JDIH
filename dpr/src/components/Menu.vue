<template>
    <main class="bg-white p-3 my-2">
        <div class="d-flex flex-wrap justify-content-between">
            <div v-for="(data, i) in related_links" :key="'related_link' + i" class="col-4 p-1">
                <div :style="'background-color:' + colors[i] + '; min-height: 54px; height:54px;'">
                    <a :href="data.link" class="w-100 h-100 d-flex justify-content-center align-items-center text-white text-decoration-none text-center">
                        {{data.title}}
                    </a>
                </div>
            </div>
        </div>
    </main>
</template>
<script>
    import axios from 'axios'
    export default {
        name: "Menu",
        data(){
            return {
                colors:[
                    "rgb(227, 68, 103)",
                    "rgb(54, 182, 182)",
                    "rgb(75, 163, 222)",
                    "rgb(24, 112, 171)",
                    "rgb(242, 140, 61)",
                    "rgb(220, 22, 65)"
                ],
                related_links:[]
            }
        },
        created(){
            axios.get("http://127.0.0.1:8000/api/related-links").then(response => {
                this.related_links = response.data
            })
        }
    }
</script>