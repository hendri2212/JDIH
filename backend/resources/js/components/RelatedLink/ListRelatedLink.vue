<template>    
    <page-header :breadcrumb='breadcrumb' :page_title="'Link Terkait'"></page-header>
    <section class="main--content">
        <panel>
            <div class="records--header">
                <div class="title fa-shopping-bag">
                    <h3 class="h3">Link Terkait <router-link :to="{ name:'ListRelatedLink' }" class="btn btn-sm btn-outline-info">Manage Link Terkait</router-link></h3>
                    <p>Ditemukan Total {{ countRelatedLink }} Link Terkait</p>
                </div>

                <div class="actions">
                    <!-- <form action="#" class="search flex-wrap flex-md-nowrap">
                        <input type="text" class="form-control" placeholder="Link Terkait..." required>
                        <select name="select" class="form-control">
                            <option value="" selected>Product Category</option>
                        </select>
                        <button type="submit" class="btn btn-rounded"><i class="fa fa-search"></i></button>
                    </form> -->

                    <router-link to="/related-link/create" class="addRelatedLink btn btn-lg btn-rounded btn-warning">Tambah Link Terkait</router-link>
                </div>
            </div>
        </panel>
        <panel class="pt-4">
            <data-table filter :rows="related_link" :pagination="pagination" sn @loadData="getRelatedLink" :perPageOptions="[15, 25, 50]" :loading="loading" :query="query">
                <template #thead>
                    <!-- <table-head>NO</table-head> -->
                    <table-head>NAMA LINK</table-head>
                    <table-head>LINK</table-head>
                    <table-head>ACTION</table-head>
                </template>
                <template #tbody="{row}">
                    <!-- <table-body v-text="row.id"></table-body> -->
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
                            <li><span class="dropdown-item" @click="showModalDelete(row.id)">Delete</span></li>
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
import { ref, computed, inject } from 'vue'
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
        const swal = inject('$swal')
        const breadcrumb = route.meta.breadcrumb
        const loading = ref(true)
        const related_link = ref([])
        const pagination = ref({
            per_page:15
        })
        const query = ref({})
        const countRelatedLink = computed(() => related_link.value.length)

        const getRelatedLink = async ({page=1, per_page=15, search=''}) => {
            loading.value = true
            let isSearching = search ? `&search=${search}` : ''
            await axios.get(window.location.origin + `/api/admin/related-link?page=${page}&per_page=${per_page}${isSearching}`).then(response => {
                if(response.data.data.length > 0){
                    related_link.value = response.data.data
                    pagination.value.page = response.data.meta.current_page
                    pagination.value.total = response.data.meta.total
                    pagination.value.per_page = 15
                    query.value.page = response.data.meta.current_page
                    query.value.search = search ? search : ''
                }
                loading.value = false
            })
            
        }

        const showModalDelete = async (id) => {
            await swal({
                title: 'Apa anda yakin?',
                text: 'Data ini akan dihapus secara permanen!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: "Yakin!",
                cancelButtonText: "Batal",
            }).then(({isConfirmed}) => {
                if (isConfirmed) {
                    axios.delete(window.location.origin + `/api/admin/related-link/${id}`).then(response => {
                        let index = related_link.value.findIndex(p => {
                            return p.id == id
                        })
                        related_link.value.splice(index, 1)
                        swal({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.data,
                        })
                    })
                }
            });
        }

        return {
            breadcrumb,
            loading,
            related_link,
            pagination,
            query,
            countRelatedLink,
            getRelatedLink,
            showModalDelete,
        }

    },
}
</script>
<style scoped>
</style>