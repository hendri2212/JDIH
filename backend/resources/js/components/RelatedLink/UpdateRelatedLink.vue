<template>
    <page-header :breadcrumb='breadcrumb' :page_title="'Tambah Link Terkait'"></page-header>
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
            <div class="records--body">
                <div class="title">
                    <h6 class="h6">Detail Link Terkait</h6>

                    <!-- <a href="#" class="btn btn-rounded btn-danger">Hapus Link Terkait</a> -->
                </div>
                <form @submit.prevent="updateRelatedLink">
                    <div class="form-group row">
                        <span class="label-text col-md-3 col-form-label">Judul Link Terkait: *</span>

                        <div class="col-md-9">
                            <input type="text" name="title" class="form-control" v-model="title" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <span class="label-text col-md-3 col-form-label">Link Terkait: *</span>

                        <div class="col-md-9">
                            <input v-model="link" type="url" name="link" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-9 offset-md-3">
                            <!-- <span class="px-3 text-primary" style="cursor: pointer;">Simpan Draft</span> -->
                            <input type="submit" value="Update Link Terkait" class="btn btn-rounded btn-success">
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

        const title = ref('')
        const link = ref('')
        const getRelatedLink = async () => {
            await axios.get(window.location.origin + '/api/admin/related-link/'+ route.params.id).then(response => {
                title.value = response.data.title
                link.value = response.data.link
            })
        }
        const updateRelatedLink = async () => {
            let formData = {
                title:  title.value,
                link: link.value
            }
            axios.post(window.location.origin + '/api/admin/related-link/'+ route.params.id, formData).then(response => {
                swal({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: response.data,
                })
            }).catch(() => {
                swal({
                    icon: 'error',
                    title: 'Gagal!',
                    text: response.data,
                })
            })
        }   
        getRelatedLink()
        // onMounted(getRelatedLink)

        return {
            breadcrumb,
            title,
            link,
            updateRelatedLink
        }
    },
}
</script>
<style>
    .ck-editor__editable {
        height: 400px !important;
    }
</style>