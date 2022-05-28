<template>    
    <page-header :breadcrumb='breadcrumb' :page_title="'News'"></page-header>
    <section class="main--content">
        <panel>
            <div class="records--header">
                <div class="title fa-shopping-bag">
                    <h3 class="h3">Berita <a href="#" class="btn btn-sm btn-outline-info">Manage Berita</a></h3>
                    <p>Ditemukan Total 1,330 Berita</p>
                </div>

                <div class="actions">
                    <form action="#" class="search flex-wrap flex-md-nowrap">
                        <input type="text" class="form-control" placeholder="Judul berita..." required>
                        <!-- <select name="select" class="form-control">
                            <option value="" selected>Product Category</option>
                        </select> -->
                        <button type="submit" class="btn btn-rounded"><i class="fa fa-search"></i></button>
                    </form>

                    <router-link to="/news/create" class="addNews btn btn-lg btn-rounded btn-warning">Tambah Berita</router-link>
                </div>
            </div>
        </panel>
        <panel>
            <data-table :rows="news">
                <template #thead>
                    <table-head>NO</table-head>
                    <!-- <table-head>SLUG</table-head> -->
                    <table-head>JUDUL</table-head>
                    <table-head>FOTO</table-head>
                    <!-- <table-head>CONTENT</table-head> -->
                    <table-head>PENULIS</table-head>
                    <table-head></table-head>
                </template>
                <template #tbody="{row}">
                    <table-body v-text="row.id"></table-body>
                    <!-- <table-body v-text="row.slug"></table-body> -->
                    <table-body v-text="row.title"></table-body>
                    <table-body>
                        <img style="max-width: 80px;"
                            :src="'../storage/'+row.photo"
                            :alt="row.title">
                    </table-body>
                    <!-- <table-body v-text="row.content"></table-body> -->
                    <table-body v-text="row.author.name"></table-body>
                    <table-body>
                        <!-- <div class="dropleft">
                            <a href="#" class="btn-link" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>

                            <div class="dropdown-menu">
                                <a href="#" class="dropdown-item">Edit</a>
                                <a href="#" class="dropdown-item">Delete</a>
                            </div>
                        </div> -->
                        <div class="dropdown">
                        <button class="bg-white border-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><router-link class="dropdown-item" :to="{name:'UpdateNews', params:{id:row.id}}">Edit</router-link></li>
                            <li><a class="dropdown-item" href="#">Delete</a></li>
                        </ul>
                        </div>
                    </table-body>
                </template>
            </data-table>
        </panel>
    </section>
</template>
<script>
import { onMounted, ref } from 'vue'
import { useRoute } from 'vue-router'
import axios from 'axios'
axios.defaults.withCredentials = true;
import PageHeader from '../PageHeader.vue'
import Panel from '../Panel.vue'
import { DataTable, TableHead, TableBody } from '@jobinsjp/vue3-datatable'

export default {
    components: {
        PageHeader,
        Panel,
        DataTable,
        TableHead,
        TableBody
    },
    setup() {
        const route = useRoute()
        const breadcrumb = route.meta.breadcrumb

        const news = ref([])
        const pagination = ref({})

        const getNews = async () => {
            await axios.get(window.location.origin + '/api/admin/news').then(response => {
                news.value = response.data.data
                pagination.value = {
                    links: response.data.links,
                    meta: response.data.meta
                }
            })
            
        }
        
        getNews()
        // onMounted(getNews)

        return {
            breadcrumb,
            news,
            pagination
        }

    },
}
</script>
<style scoped>
</style>