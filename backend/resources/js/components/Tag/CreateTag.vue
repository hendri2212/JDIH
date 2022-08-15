<template>
    <page-header :breadcrumb='breadcrumb' :page_title="'Tambah Tag'"></page-header>
    <section class="main--content">
        <panel>
            <div class="records--header">
                <div class="title fa-shopping-bag">
                     <h3 class="h3">Tag <router-link :to="{ name:'ListTag' }" class="btn btn-sm btn-outline-info">Manage Tag</router-link></h3>
                    <!-- <p>Ditemukan Total 1,330 Tag</p> -->
                </div>

                <!-- <div class="actions">
                    <form action="#" class="search flex-wrap flex-md-nowrap">
                        <input type="text" class="form-control" placeholder="Tag..." required>
                        <button type="submit" class="btn btn-rounded"><i class="fa fa-search"></i></button>
                    </form>
                </div> -->
            </div>
        </panel>
        <panel>
            <div class="records--body">
                <div class="title">
                    <h6 class="h6">Detail Tag</h6>

                    <!-- <a href="#" class="btn btn-rounded btn-danger">Hapus Tag</a> -->
                </div>
                <form @submit.prevent="createTag">
                    <div class="form-group row">
                        <span class="label-text col-md-3 col-form-label">Tag: *</span>

                        <div class="col-md-9">
                            <input type="text" name="title" class="form-control" v-model="title" required>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-9 offset-md-3">
                            <!-- <span class="px-3 text-primary" style="cursor: pointer;">Simpan Draft</span> -->
                            <input type="submit" value="Tambah Tag" class="btn btn-rounded btn-success">
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

        const createTag = async () => {
            let formData = {
                title:  title.value
            }
            axios.post(window.location.origin + '/api/admin/tags/create', formData).then(response => {
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

        return {
            breadcrumb,
            title,
            createTag
        }
    },
}
</script>