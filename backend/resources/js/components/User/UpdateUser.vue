<template>
    <page-header :breadcrumb='breadcrumb' :page_title="'Tambah Program Kerja'"></page-header>
    <section class="main--content">
        <panel>
            <div class="records--header">
                <div class="title fa-shopping-bag">
                     <h3 class="h3">Program Kerja <router-link :to="{ name:'ListWorkPlan' }" class="btn btn-sm btn-outline-info">Manage Program Kerja</router-link></h3>
                    <!-- <p>Ditemukan Total 1,330 Program Kerja</p> -->
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
            <div class="records--body">
                <div class="title">
                    <h6 class="h6">Detail Program Kerja</h6>

                    <!-- <a href="#" class="btn btn-rounded btn-danger">Hapus Program Kerja</a> -->
                </div>
                <form @submit.prevent="updateWorkPlan">
                    <div class="form-group row">
                        <span class="label-text col-md-3 col-form-label">Anggota Dewan: *</span>

                        <div class="col-md-9">
                            <select  class="form-control" name="id_user" v-model="id_user" required>
                                <option v-for="data in dpr" :value="data.id_user">{{ data.name }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <span class="label-text col-md-3 col-form-label">Program Kerja: *</span>

                        <div class="col-md-9">
                            <input type="text" name="title" class="form-control" v-model="title" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <span class="label-text col-md-3 col-form-label">Deskripsi Program Kerja: *</span>

                        <div class="col-md-9">
                            <textarea  v-model="content" name="content" class="form-control" rows="15" required></textarea>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-9 offset-md-3">
                            <!-- <span class="px-3 text-primary" style="cursor: pointer;">Simpan Draft</span> -->
                            <input type="submit" value="Update Program Kerja" class="btn btn-rounded btn-success">
                        </div>
                    </div>
                </form>
            </div>
        </panel>
    </section>
</template>

<script>
import { ref, inject } from 'vue'
import { useRoute } from 'vue-router'
import PageHeader from '../PageHeader'
import Panel from '../Panel'
import axios from 'axios'
axios.defaults.withCredentials = true;
export default {
    components: {
        PageHeader,
        Panel
    },
    setup() {
        const route = useRoute()
        const swal = inject('$swal')
        const breadcrumb = route.meta.breadcrumb
        const dpr = ref([])
        const title = ref('')
        const content = ref('')
        const id_user = ref('')
        const getWorkPlan = async () => {
            await axios.get(window.location.origin + '/api/admin/work-plan/'+ route.params.id).then(response => {
                title.value = response.data.title
                content.value = response.data.content
                id_user.value = response.data.author.id
            })
        }
        const getDpr = async () => {
            await axios.get(window.location.origin + '/api/legislator/member').then(response => {
                dpr.value = response.data
            })
        }
        const updateWorkPlan = async () => {
            let formData = {
                title:  title.value,
                content: content.value,
                id_user: id_user.value,
            }
            axios.post(window.location.origin + '/api/admin/work-plan/'+ route.params.id, formData).then(response => {
                swal({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: response.data,
                })
            }).catch((response) => {
                swal({
                    icon: 'error',
                    title: 'Gagal!',
                    text: response.data,
                })
            })
        }   
        getDpr()
        getWorkPlan()

        return {
            breadcrumb,
            dpr,
            title,
            content,
            id_user,
            updateWorkPlan
        }
    },
}
</script>
<style>
    .ck-editor__editable {
        height: 400px !important;
    }
</style>