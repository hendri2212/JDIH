<template>
    <page-header :breadcrumb='breadcrumb' :page_title="'Tambah Tag'"></page-header>
    <section class="main--content">
        <panel>
            <div class="records--header">
                <div class="title fa-shopping-bag">
                     <h3 class="h3">Tag <router-link :to="{ name:'ListTag' }" class="btn btn-sm btn-outline-info">Manage Tag</router-link></h3>
                    <!-- <p>Ditemukan Total 1,330 Tag</p> -->
                </div>

                <div class="actions">
                    <!-- <form action="#" class="search flex-wrap flex-md-nowrap">
                        <input type="text" class="form-control" placeholder="Tag..." required>
                        <select name="select" class="form-control">
                            <option value="" selected>Product Category</option>
                        </select>
                        <button type="submit" class="btn btn-rounded"><i class="fa fa-search"></i></button>
                    </form> -->

                    <router-link to="/tag/create" class="addRelatedLink btn btn-lg btn-rounded btn-warning">Tambah Tag</router-link>
                </div>
            </div>
        </panel>
        <panel>
            <div class="records--body">
                <div class="title">
                    <h6 class="h6">Detail Tag</h6>

                    <span class="btn btn-rounded btn-danger" @click="showModalDelete(route.params.id)">Hapus Tag</span>
                </div>
                <form @submit.prevent="updateTag">
                    <div class="form-group row">
                        <span class="label-text col-md-3 col-form-label">Tag: *</span>

                        <div class="col-md-9">
                            <input type="text" name="title" class="form-control" v-model="title" required>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-9 offset-md-3">
                            <!-- <span class="px-3 text-primary" style="cursor: pointer;">Simpan Draft</span> -->
                            <input type="submit" value="Update Tag" class="btn btn-rounded btn-success">
                        </div>
                    </div>
                </form>
            </div>
        </panel>
    </section>
</template>

<script>
import { ref, inject } from 'vue'
import { useRoute, useRouter } from 'vue-router'
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
        const router = useRouter()
        const swal = inject('$swal')
        const breadcrumb = route.meta.breadcrumb
        const title = ref('')
        const getTag = async () => {
            await axios.get(window.location.origin + '/api/admin/tags/'+ route.params.id).then(response => {
                title.value = response.data.title
            })
        }
        const updateTag = async () => {
            let formData = {
                title:  title.value,
            }
            axios.post(window.location.origin + '/api/admin/tags/'+ route.params.id, formData).then(response => {
                swal({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: response.data,
                })
            }).catch(({response}) => {
                swal({
                    icon: 'error',
                    title: 'Gagal!',
                    text: JSON.stringify(response.data),
                })
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
                    axios.delete(window.location.origin + `/api/admin/tags/${id}`).then(response => {
                        swal({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.data,
                        }).then(() => {
                            router.push({name:'ListTag'})
                        })
                    })
                }
            });
        }
        getTag()

        return {
            breadcrumb,
            route,
            title,
            updateTag,
            showModalDelete
        }
    },
}
</script>
<style>
    .ck-editor__editable {
        height: 400px !important;
    }
</style>