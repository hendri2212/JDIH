<template>    
    <page-header :breadcrumb='breadcrumb' :page_title="'News'"></page-header>
    <section class="main--content">
        <panel>
            <div class="records--header">
                <div class="title fa-shopping-bag">
                    <h3 class="h3">Berita <router-link :to="{ name:'ListNews' }" class="btn btn-sm btn-outline-info">Manage Berita</router-link></h3>
                    <p>Ditemukan Total {{ countNews }} Berita</p>
                </div>

                <div class="actions">
                    <!-- <form action="#" class="search flex-wrap flex-md-nowrap">
                        <input type="text" class="form-control" placeholder="Judul berita..." required>
                        <select name="select" class="form-control">
                            <option value="" selected>Product Category</option>
                        </select>
                        <button type="submit" class="btn btn-rounded"><i class="fa fa-search"></i></button>
                    </form> -->

                    <router-link to="/news/create" class="addNews btn btn-lg btn-rounded btn-warning">Tambah Berita</router-link>
                </div>
            </div>
        </panel>
        <panel>
            <data-table filter :rows="news" :pagination="pagination" sn @loadData="getNews" :perPageOptions="[15, 25, 50]" :loading="loading" :query="query">
                <template #thead>
                    <!-- <table-head>NO</table-head> -->
                    <!-- <table-head>SLUG</table-head> -->
                    <table-head>JUDUL</table-head>
                    <table-head>FOTO</table-head>
                    <!-- <table-head>CONTENT</table-head> -->
                    <table-head>PENULIS</table-head>
                    <table-head>ACTION</table-head>
                </template>
                <template #tbody="{row}">
                    <!-- <table-body v-text="row.id"></table-body> -->
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
                <template #empty>
                    <TableBodyCell colspan="2">
                        Tidak ada hasil ditemukan
                    </TableBodyCell>
                </template>
            </data-table>
        </panel>
    </section>
</template>
<script>
import { ref, computed } from 'vue'
import { useRoute } from 'vue-router'
import axios from 'axios'
axios.defaults.withCredentials = true;
import PageHeader from '../PageHeader.vue'
import Panel from '../Panel.vue'
import { DataTable, TableHead, TableBody, TableBodyCell } from '@jobinsjp/vue3-datatable'

export default {
    components: {
        PageHeader,
        Panel,
        DataTable,
        TableHead,
        TableBody,
        TableBodyCell,
    },
    setup() {
        const route = useRoute()
        const breadcrumb = route.meta.breadcrumb
        const loading = ref(true)
        const news = ref([])
        const pagination = ref({
            per_page:15
        })
        const query = ref({})
        const countNews = computed(() => news.value.length)

        const getNews = async ({page=1, per_page=15, search=''}) => {
            loading.value = true
            let isSearching = search ? `&search=${search}` : ''
            await axios.get(window.location.origin + `/api/admin/news?page=${page}&per_page=${per_page}${isSearching}`).then(response => {
                if(response.data.data.length > 0){
                    news.value = response.data.data
                    pagination.value.page = response.data.meta.current_page
                    pagination.value.total = response.data.meta.total
                    pagination.value.per_page = 15
                    query.value.page = response.data.meta.current_page
                    query.value.search = search ? search : ''
                }
                loading.value = false
            })
            
        }

        return {
            breadcrumb,
            loading,
            news,
            countNews,
            pagination,
            query,
            getNews
        }

    },
}
</script>
<style scoped>
</style>