<template>
    <main class="bg-white p-3 my-2">
        <div class="d-flex flex-wrap justify-content-start">
            <router-link :to="{ name: 'aspiration' }" class="col-4 p-1 mb-2 align-middle text-center text-decoration-none" style="height: 65px">
                <div class="rounded-3 p-1" style="background-color: #E34467">
                    <img src="@/assets/ambition.png" class="img-fluid rounded-3"><br>
                    <span class="text-white fw-bold small">Aspirasi</span>
                </div>
            </router-link>
            <a href="http://jdih.kotabarukab.go.id/data/www/index.php" target="_blank" class="col-4 p-1 mb-2 align-middle text-center text-decoration-none" style="height: 65px">
                <div class="rounded-3 p-1" style="background-color: #36B6B6">
                    <img src="https://jdih.kuduskab.go.id/assets/uploads/icon/jdihn.png" class="img-fluid rounded-3" style="width: 32px"><br>
                    <span class="text-white fw-bold small">JDIH</span>
                </div>
            </a>
            <router-link :to="{ name: 'news' }" class="col-4 p-1 mb-2 align-middle text-center text-decoration-none" style="height: 65px">
                <div class="rounded-3 p-1" style="background-color: #4BA3DE">
                    <img src="@/assets/team.png" class="img-fluid rounded-3"><br>
                    <span class="text-white fw-bold small">Anggota DPRD</span>
                </div>
            </router-link>
            <router-link :to="{ name: 'news' }" class="col-4 p-1 mb-2 align-middle text-center text-decoration-none" style="height: 65px">
                <div class="rounded-3 p-1" style="background-color: #1870AB">
                    <img src="@/assets/link.png" class="img-fluid rounded-3"><br>
                    <span class="text-white fw-bold small">Link Terkait</span>
                </div>
            </router-link>
            <router-link :to="{ name: 'news' }" class="col-4 p-1 mb-2 align-middle text-center text-decoration-none" style="height: 65px">
                <div class="rounded-3 p-1" style="background-color: #F28C3D">
                    <img src="@/assets/news.png" class="img-fluid rounded-3"><br>
                    <span class="text-white fw-bold small">News</span>
                </div>
            </router-link>
            <router-link :to="{ name: 'news' }" class="col-4 p-1 mb-2 align-middle text-center text-decoration-none" style="height: 65px">
                <div class="rounded-3 p-1" style="background-color: #DC1641">
                    <img src="@/assets/tukarjual.png" class="img-fluid rounded-3" style="width: 32px"><br>
                    <span class="text-white fw-bold small">TukarJual</span>
                </div>
            </router-link>
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
<!-- <div class="d-flex flex-wrap justify-content-between">
            <div v-for="(data, i) in related_links" :key="'related_link' + i" class="col-4 p-1">
                <div :style="'background-color:' + colors[i] + '; min-height: 54px; height:54px;'">
                    <a :href="data.link" class="w-100 h-100 d-flex justify-content-center align-items-center text-white text-decoration-none text-center">
                        {{data.title}}
                    </a>
                </div>
            </div> -->