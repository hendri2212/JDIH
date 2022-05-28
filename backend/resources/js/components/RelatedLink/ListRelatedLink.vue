<template>    
    <page-header :breadcrumb='breadcrumb' :page_title="'Link Terkait'"></page-header>
    <section class="main--content">
        <panel>
            <div class="records--header">
                <div class="title fa-shopping-bag">
                    <h3 class="h3">Link Terkait <a href="#" class="btn btn-sm btn-outline-info">Manage Link Terkait</a></h3>
                    <p>Ditemukan Total 1,330 Link Terkait</p>
                </div>

                <div class="actions">
                    <form action="#" class="search flex-wrap flex-md-nowrap">
                        <input type="text" class="form-control" placeholder="Link Terkait..." required>
                        <!-- <select name="select" class="form-control">
                            <option value="" selected>Product Category</option>
                        </select> -->
                        <button type="submit" class="btn btn-rounded"><i class="fa fa-search"></i></button>
                    </form>

                    <router-link to="/related-link/create" class="addRelatedLink btn btn-lg btn-rounded btn-warning">Tambah Link Terkait</router-link>
                </div>
            </div>
        </panel>
        <panel>
            <data-table :rows="related_link">
                <template #thead>
                    <table-head>NO</table-head>
                    <table-head>NAMA LINK</table-head>
                    <table-head>LINK</table-head>
                    <table-head></table-head>
                </template>
                <template #tbody="{row}">
                    <table-body v-text="row.id"></table-body>
                    <!-- <table-body v-text="row.slug"></table-body> -->
                    <table-body v-text="row.title"></table-body>
                    <!-- <table-body v-text="row.content"></table-body> -->
                    <table-body v-text="row.link"></table-body>
                    <table-body>
                        <div class="dropdown">
                        <button class="bg-white border-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><router-link class="dropdown-item" :to="{name:'UpdateRelatedLink', params:{id:row.id}}">Edit</router-link></li>
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
import { ref } from 'vue'
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

        const related_link = ref([])
        const pagination = ref({})

        const getRelatedLink = async () => {
            await axios.get(window.location.origin + '/api/admin/related-link').then(response => {
                if(response.data.length > 0){
                    related_link.value = response.data.data
                    pagination.value = {
                        links: response.data.links,
                        meta: response.data.meta
                    }
                }
            })
            
        }
        
        getRelatedLink()

        return {
            breadcrumb,
            related_link,
            pagination
        }

    },
}
</script>
<style scoped>
</style>