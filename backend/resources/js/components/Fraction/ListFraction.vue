<template>    
    <page-header :breadcrumb='breadcrumb' :page_title="'Fraksi'"></page-header>
    <section class="main--content">
        <panel>
            <div class="records--header">
                <div class="title fa-shopping-bag">
                    <h3 class="h3">Fraksi <a href="#" class="btn btn-sm btn-outline-info">Manage Fraksi</a></h3>
                    <p>Ditemukan Total 1,330 Fraksi</p>
                </div>

                <div class="actions">
                    <form action="#" class="search flex-wrap flex-md-nowrap">
                        <input type="text" class="form-control" placeholder="Fraksi..." required>
                        <button type="submit" class="btn btn-rounded"><i class="fa fa-search"></i></button>
                    </form>

                    <router-link to="/fraction/create" class="addFraction btn btn-lg btn-rounded btn-warning">Tambah Fraksi</router-link>
                </div>
            </div>
        </panel>
        <panel>
            <data-table :rows="fractions">
                <template #thead>
                    <table-head>NO</table-head>
                    <table-head>LAMBANG FRAKSI</table-head>
                    <table-head>NAMA FRAKSI</table-head>
                    <table-head></table-head>
                </template>
                <template #tbody="{row}">
                    <table-body v-text="row.id"></table-body>
                    <!-- <table-body v-text="row.slug"></table-body> -->
                    <table-body>
                        <img style="max-width: 80px;"
                            :src="'../storage/'+row.photo"
                            :alt="row.title">
                    </table-body>
                    <!-- <table-body v-text="row.content"></table-body> -->
                    <table-body v-text="row.title"></table-body>
                    <table-body>
                        <div class="dropdown">
                        <button class="bg-white border-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><router-link class="dropdown-item" :to="{name:'UpdateFraction', params:{id:row.id}}">Edit</router-link></li>
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

        const fractions = ref([])
        const pagination = ref({})

        const getFractions = async () => {
            await axios.get(window.location.origin + '/api/admin/fraction').then(response => {
                if(response.data.length > 0){
                    fractions.value = response.data.data
                    pagination.value = {
                        links: response.data.links,
                        meta: response.data.meta
                    }
                }
            })
            
        }
        
        getFractions()

        return {
            breadcrumb,
            fractions,
            pagination
        }

    },
}
</script>
<style scoped>
</style>