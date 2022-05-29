<template>    
    <page-header :breadcrumb='breadcrumb' :page_title="'Akun'"></page-header>
    <section class="main--content">
        <panel>
            <div class="records--header">
                <div class="title fa-shopping-bag">
                    <h3 class="h3">Akun <router-link :to="{ name:'ListUser' }" class="btn btn-sm btn-outline-info">Manage Akun</router-link></h3>
                    <p>Ditemukan Total {{ countUser }} Akun</p>
                </div>

                <div class="actions">
                    <!-- <form action="#" class="search flex-wrap flex-md-nowrap">
                        <input type="text" class="form-control" placeholder="Akun..." required>
                        <select name="select" class="form-control">
                            <option value="" selected>Product Category</option>
                        </select>
                        <button type="submit" class="btn btn-rounded"><i class="fa fa-search"></i></button>
                    </form> -->

                    <router-link to="/user/create" class="addUser btn btn-lg btn-rounded btn-warning">Tambah Akun</router-link>
                </div>
            </div>
        </panel>
        <panel>
            <data-table filter :rows="user" :pagination="pagination" sn @loadData="getUser" :perPageOptions="[15, 25, 50]" :loading="loading" :query="query">
                <template #thead>
                    <!-- <table-head>NO</table-head> -->
                    <table-head>PHOTO</table-head>
                    <table-head>NAMA</table-head>
                    <table-head>USERNAME</table-head>
                    <table-head>CATEGORY</table-head>
                    <table-head>TANGGAL</table-head>
                    <table-head>ACTION</table-head>
                </template>
                <template #tbody="{row}">
                    <!-- <table-body v-text="row.id"></table-body> -->
                    <table-body v-text="row.photo"></table-body>
                    <table-body v-text="row.name"></table-body>
                    <table-body v-text="row.username"></table-body>
                    <table-body v-text="row.type"></table-body>
                    <table-body v-text="row.created_at"></table-body>
                    <table-body>
                        <div class="dropdown">
                        <button class="bg-white border-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><router-link class="dropdown-item" :to="{name:'UpdateUser', params:{id:row.id}}">Edit</router-link></li>
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
import { computed, ref, inject } from 'vue'
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
        const user = ref([])
        const query = ref({})
        const pagination = ref({
            per_page:15
        })
        const countUser = computed(() => user.value.length)

        const getUser = async ({page=1, per_page=15, search=''}) => {
            loading.value = true
            let isSearching = search ? `&search=${search}` : ''
            await axios.get(window.location.origin + `/api/admin/user?page=${page}&per_page=${per_page}${isSearching}`).then(response => {
                if(response.data.data.length > 0){
                    user.value = response.data.data
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
                    axios.delete(window.location.origin + `/api/admin/user/${id}`).then(response => {
                        let index = user.value.findIndex(p => {
                            return p.id == id
                        })
                        user.value.splice(index, 1)
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
            user,
            countUser,
            pagination,
            query,
            getUser,
            showModalDelete,
        }

    },
}
</script>
<style scoped>
</style>