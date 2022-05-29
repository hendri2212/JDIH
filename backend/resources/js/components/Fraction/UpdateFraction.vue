<template>
    <page-header :breadcrumb='breadcrumb' :page_title="'Tambah Fraksi'"></page-header>
    <section class="main--content">
        <panel>
            <div class="records--header">
                <div class="title fa-shopping-bag">
                    <h3 class="h3">Fraksi <router-link :to="{name:'ListFraction'}" class="btn btn-sm btn-outline-info">Manage Fraksi</router-link></h3>
                    <!-- <p>Ditemukan Total 1,330 Fraksi</p> -->
                </div>

                <div class="actions">
                    <form action="#" class="search flex-wrap flex-md-nowrap">
                        <input type="text" class="form-control" placeholder="Fraksi..." required>
                        <!-- <select name="select" class="form-control">
                            <option value="" selected>Product Category</option>
                        </select> -->
                        <button type="submit" class="btn btn-rounded"><i class="fa fa-search"></i></button>
                    </form>

                    <router-link to="/fraction/create" class="addRelatedLink btn btn-lg btn-rounded btn-warning">Tambah Fraksi</router-link>
                </div>
            </div>
        </panel>
        <panel>
            <div class="records--body">
                <div class="title">
                    <h6 class="h6">Detail Fraksi</h6>

                    <!-- <a href="#" class="btn btn-rounded btn-danger">Hapus Fraksi</a> -->
                </div>
                <form @submit.prevent="updateFraksi">
                    <div class="form-group row">
                        <span class="label-text col-md-3 col-form-label">Nama Fraksi: *</span>

                        <div class="col-md-9">
                            <input type="text" name="title" class="form-control" v-model="title" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <span class="label-text col-md-3 col-form-label">Lambang Fraksi: *</span>

                        <div class="col-md-9">
                            <input ref="photo" type="file" name="photo" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-9 offset-md-3">
                            <!-- <span class="px-3 text-primary" style="cursor: pointer;">Simpan Draft</span> -->
                            <input type="submit" value="Tambah Fraksi" class="btn btn-rounded btn-success">
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

        const name = ref('')
        const photo = ref(null)
        const getFraction = async () => {
            await axios.get(window.location.origin + '/api/admin/fraction/'+ route.params.id).then(response => {
                name.value = response.data.name
                photo.value = response.data.photo
            })
        }
        const updateFraksi = async () => {
            let formData =  new FormData()
            formData.append('name', name.value)
            formData.append('photo', photo.value.files[0])
            axios.post(window.location.origin + '/api/admin/fraction/'+ route.params.id, formData).then(response => {
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
        getFraction()
        // onMounted(getFraction)

        return {
            breadcrumb,
            name,
            photo,
            updateFraksi
        }
    },
}
</script>
<style>
    .ck-editor__editable {
        height: 400px !important;
    }
</style>