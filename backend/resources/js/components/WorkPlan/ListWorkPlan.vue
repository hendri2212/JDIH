<template>    
    <page-header :breadcrumb='breadcrumb' :page_title="'Program Kerja'"></page-header>
    <section class="main--content">
        <panel>
            <div class="records--header">
                <div class="title fa-shopping-bag">
                    <h3 class="h3">Program Kerja <router-link :to="{ name:'ListWorkPlan' }" class="btn btn-sm btn-outline-info">Manage Program Kerja</router-link></h3>
                    <p>Ditemukan Total {{ countWorkPlan }} Program Kerja</p>
                </div>

                <div class="actions">
                    <!-- <form action="#" class="search flex-wrap flex-md-nowrap">
                        <input type="text" class="form-control" placeholder="Program Kerja..." required>
                        <select name="select" class="form-control">
                            <option value="" selected>Product Category</option>
                        </select>
                        <button type="submit" class="btn btn-rounded"><i class="fa fa-search"></i></button>
                    </form> -->

                    <router-link to="/work-plan/create" class="addRelatedLink btn btn-lg btn-rounded btn-warning">Tambah Program Kerja</router-link>
                </div>
            </div>
        </panel>
        <panel>
            <data-table filter :rows="work_plan" :pagination="pagination" sn @loadData="getWorkPlan" :perPageOptions="[15, 25, 50]" :loading="loading" :query="query">
                <template #thead>
                    <!-- <table-head>NO</table-head> -->
                    <table-head>PROGRAM KERJA</table-head>
                    <table-head>TANGGAL</table-head>
                    <table-head>ACTION</table-head>
                </template>
                <template #tbody="{row}">
                    <!-- <table-body v-text="row.id"></table-body> -->
                    <table-body v-text="row.title"></table-body>
                    <table-body v-text="row.created_at"></table-body>
                    <table-body>
                        <div class="dropdown">
                        <button class="bg-white border-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><router-link class="dropdown-item" :to="{name:'UpdateWorkPlan', params:{id:row.id}}">Edit</router-link></li>
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
        const work_plan = ref([])
        const query = ref({})
        const pagination = ref({
            per_page:15
        })
        const countWorkPlan = computed(() => work_plan.value.length)

        const getWorkPlan = async ({page=1, per_page=15, search=''}) => {
            loading.value = true
            let isSearching = search ? `&search=${search}` : ''
            await axios.get(window.location.origin + `/api/admin/work-plan?page=${page}&per_page=${per_page}${isSearching}`).then(response => {
                if(response.data.data.length > 0){
                    work_plan.value = response.data.data
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
                    axios.delete(window.location.origin + `/api/admin/work-plan/${id}`).then(response => {
                        let index = work_plan.value.findIndex(p => {
                            return p.id == id
                        })
                        work_plan.value.splice(index, 1)
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
            work_plan,
            countWorkPlan,
            pagination,
            query,
            getWorkPlan,
            showModalDelete,
        }

    },
}
</script>
<style scoped>
</style>