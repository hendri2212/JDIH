<template>    
    <page-header :breadcrumb='breadcrumb' :page_title="'Fraksi'"></page-header>
    <section class="main--content">
        <panel>
            <div class="records--header">
                <div class="title fa-shopping-bag">
                    <h3 class="h3">Fraksi <router-link :to="{name:'ListFraction'}" class="btn btn-sm btn-outline-info">Manage Fraksi</router-link></h3>
                    <p>Ditemukan Total {{ countFractions }} Fraksi</p>
                </div>

                <div class="actions">
                    <!-- <form @submit.prevent="getFractions" class="search flex-wrap flex-md-nowrap">
                        <input type="search" v-model="search" class="form-control" placeholder="Nama Fraksi...">
                        <button type="submit" class="btn btn-rounded"><i class="fa fa-search"></i></button>
                    </form> -->

                    <router-link to="/fraction/create" class="addFraction btn btn-lg btn-rounded btn-warning">Tambah Fraksi</router-link>
                </div>
            </div>
        </panel>
        <panel class="pt-4">
            <data-table filter :rows="fractions" :pagination="pagination" sn @loadData="getFractions" :perPageOptions="[15, 25, 50]" :loading="loading" :query="query">
                <template #thead>
                    <!-- <table-head>NO</table-head> -->
                    <table-head>LAMBANG FRAKSI</table-head>
                    <table-head>NAMA FRAKSI</table-head>
                    <table-head>ACTION</table-head>
                </template>
                <template #tbody="{row}">
                    <!-- <table-body v-text="row.id"></table-body> -->
                    <!-- <table-body v-text="row.slug"></table-body> -->
                    <table-body>
                        <img style="max-width: 80px;"
                            :src="'../storage/'+row.photo"
                            :alt="row.title">
                    </table-body>
                    <!-- <table-body v-text="row.content"></table-body> -->
                    <table-body v-text="row.name"></table-body>
                    <table-body>
                        <div class="dropdown">
                        <button class="bg-white border-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><router-link class="dropdown-item" :to="{name:'UpdateFraction', params:{id:row.id}}">Edit</router-link></li>
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
        const fractions = ref([])
        const pagination = ref({
            per_page:15
        })
        const query = ref({})
        const countFractions = computed(() => fractions.value.length)

        const getFractions = async ({page=1, per_page=15, search=''}) => {
            loading.value = true
            let isSearching = search ? `&search=${search}` : ''
            await axios.get(window.location.origin + `/api/admin/fraction?page=${page}&per_page=${per_page}${isSearching}`).then(response => {
                if(response.data.data.length > 0){
                    fractions.value = response.data.data
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
                    axios.delete(window.location.origin + `/api/admin/fraction/${id}`).then(response => {
                        let index = fractions.value.findIndex(p => {
                            return p.id == id
                        })
                        fractions.value.splice(index, 1)
                        swal({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.data,
                        })
                    }).catch(({response}) => {
                        swal({
                            icon: 'error',
                            title: 'Gagal!',
                            text: response.data,
                        })
                    })
                }
            });
        }
        
        // getFractions({})

        return {
            breadcrumb,
            loading,
            fractions,
            countFractions,
            pagination,
            query,
            getFractions,
            showModalDelete
        }

    },
}
</script>
<style scoped>
</style>